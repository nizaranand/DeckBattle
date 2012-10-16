<?php

function sec_session_start() {
        $session_name = 'sec_session_id'; // Set a custom session name
        $secure = false; // Set to true if using https.
        $httponly = true; // This stops javascript being able to access the session id. 
 
        ini_set('session.use_only_cookies', 1); // Forces sessions to only use cookies. 
        $cookieParams = session_get_cookie_params(); // Gets current cookies params.
        session_set_cookie_params($cookieParams["lifetime"], $cookieParams["path"], $cookieParams["domain"], $secure, $httponly); 
        session_name($session_name); // Sets the session name to the one set above.
        session_start(); // Start the php session
        session_regenerate_id(true); // regenerated the session, delete the old one.     
}

function login($email, $password_input, $mysqli) {
	// Using prepared Statements means that SQL injection is not possible. 
	if ($stmt = $mysqli->prepare("SELECT id, username, password, salt FROM members WHERE isactivated = 1 AND email = ? LIMIT 1")) { 
		$stmt->bind_param('s', $email); // Bind "$email" to parameter.
		$stmt->execute(); // Execute the prepared query.
		$stmt->store_result();
		$stmt->bind_result($user_id, $username, $db_password, $salt); // get variables from result.
		$stmt->fetch();
		$password = hash('sha512', $password_input.$salt); // hash the password with the unique salt.
		
		if($stmt->num_rows == 1) { // If the user exists
			// We check if the account is locked from too many login attempts
			if(checkbrute($user_id, $mysqli) == true) { 
				// Account is locked
				// Send an email to user saying their account is locked
				accountLocked($email,$user_id,$mysqli);
				return false;
			} 
			else {
				if($db_password == $password) { // Check if the password in the database matches the password the user submitted. 
					// Password is correct!
					
					$ip_address = $_SERVER['REMOTE_ADDR']; // Get the IP address of the user. 
					$user_browser = $_SERVER['HTTP_USER_AGENT']; // Get the user-agent string of the user.
					
					$user_id = preg_replace("/[^0-9]+/", "", $user_id); // XSS protection as we might print this value
					$_SESSION['user_id'] = $user_id; 
					$username = preg_replace("/[^a-zA-Z0-9_\-]+/", "", $username); // XSS protection as we might print this value
					$_SESSION['username'] = $username;
					$_SESSION['login_string'] = hash('sha512', $password.$ip_address.$user_browser);
					// Login successful.
					return true;    
				} 
				else {
					// Password is not correct
					//check if the pass is from recovery
					if ($stmt = $mysqli->prepare("SELECT id, username, passrecovery, saltrecovery FROM members WHERE isactivated = 1 AND email = ? LIMIT 1")) { 
						$stmt->bind_param('s', $email); // Bind "$email" to parameter.
						$stmt->execute(); // Execute the prepared query.
						$stmt->store_result();
						$stmt->bind_result($user_id, $username, $db_password, $salt); // get variables from result.
						$stmt->fetch();
						$password = hash('sha512', $password_input.$salt); // hash the password with the unique salt.
				//	echo '<br />into pass recovery: submitted pass:' . $password_input . ' dbpass: '. $db_password . ' hashed pass with recoverd salt: ' . $password;
						
						if($stmt->num_rows == 1) { // If the user exists
					//echo '<br /> got a user intop db pass check';
							if($db_password == $password) { // Check if the password in the database matches the password the user submitted. 
								// Password is correct!
							//	echo '<br />pass correct';
								$ip_address = $_SERVER['REMOTE_ADDR']; // Get the IP address of the user. 
								$user_browser = $_SERVER['HTTP_USER_AGENT']; // Get the user-agent string of the user.
								
								$user_id = preg_replace("/[^0-9]+/", "", $user_id); // XSS protection as we might print this value
								$_SESSION['user_id'] = $user_id; 
								$username = preg_replace("/[^a-zA-Z0-9_\-]+/", "", $username); // XSS protection as we might print this value
								$_SESSION['username'] = $username;
								$_SESSION['login_string'] = hash('sha512', $password.$ip_address.$user_browser);
								// Login successful.
								return true;    
							} 
							else {
							//both passed incorrect
							// We record this attempt in the database
							$now = time();
							$mysqli->query("INSERT INTO login_attempts (user_id, time) VALUES ('$user_id', '$now')");
							return false;
							}
						}
						else {
							return false; //no user
						}
					}
					else {
						return false; //sql error
					}
				}
			}
		}
		else {
			return false;	//no user
		}
	}
	else {
		return false; //sql error
	}
}

function checkbrute($user_id, $mysqli) {
   // Get timestamp of current time
   $now = time();
   // All login attempts are counted from the past 2 hours. 
   $valid_attempts = $now - (2 * 60 * 60); 
 
   if ($stmt = $mysqli->prepare("SELECT time FROM login_attempts WHERE user_id = ? AND time > '$valid_attempts'")) { 
      $stmt->bind_param('i', $user_id); 
      // Execute the prepared query.
      $stmt->execute();
      $stmt->store_result();
      // If there has been more than 5 failed logins
      if($stmt->num_rows > 5) {
         return true;
      } else {
         return false;
      }
   }
}

function login_check($mysqli) {
   // Check if all session variables are set
   if(isset($_SESSION['user_id'], $_SESSION['username'], $_SESSION['login_string'])) {
     $user_id = $_SESSION['user_id'];
     $login_string = $_SESSION['login_string'];
     $username = $_SESSION['username'];
     $ip_address = $_SERVER['REMOTE_ADDR']; // Get the IP address of the user. 
     $user_browser = $_SERVER['HTTP_USER_AGENT']; // Get the user-agent string of the user.

     if ($stmt = $mysqli->prepare("SELECT password FROM members WHERE id = ? LIMIT 1")) { 
        $stmt->bind_param('i', $user_id); // Bind "$user_id" to parameter.
        $stmt->execute(); // Execute the prepared query.
        $stmt->store_result();
 
        if($stmt->num_rows == 1) { // If the user exists
           $stmt->bind_result($password); // get variables from result.
           $stmt->fetch();
           $login_check = hash('sha512', $password.$ip_address.$user_browser);
           if($login_check == $login_string) {
              // Logged In!!!!
			  
			  //check if a recovery pass is still active, then show a message to alert the user to change the pass
			   if ($stmt = $mysqli->prepare("SELECT passrecovery FROM members WHERE id = ? AND passrecovery != '' LIMIT 1")) { 
				$stmt->bind_param('i', $user_id); // Bind "$user_id" to parameter.
				$stmt->execute(); // Execute the prepared query.
				$stmt->store_result();
		 		
					if($stmt->num_rows == 1) 
					{
							$_SESSION['passrecoveryactive'] = 1;
					}
					else
					 {
							$_SESSION['passrecoveryactive'] = 0;
					 }
			   }
			  clearBruteForce($user_id,$mysqli);
              return true;
           } 
		   else { // WRONG PASS check pass to revocery field
	           if ($stmt = $mysqli->prepare("SELECT passrecovery FROM members WHERE id = ? LIMIT 1")) { 
				$stmt->bind_param('i', $user_id); // Bind "$user_id" to parameter.
				$stmt->execute(); // Execute the prepared query.
				$stmt->store_result();
		 		
					if($stmt->num_rows == 1) { // If the user exists
					   $stmt->bind_result($password); // get variables from result.
					   $stmt->fetch();
					   $login_check = hash('sha512', $password.$ip_address.$user_browser);
					   if($login_check == $login_string) {
						  // Logged In!!!!
						  $_SESSION['passrecoveryactive'] = 1;
						  
						  clearBruteForce($user_id,$mysqli);
						  return true;
						}	 
						else {
							return false;
						}
					}
			   	}	
				else {
					return false; //no user
				}	
           	}
        } 
		else {
            // Not logged in
            return false;
        }
     } else {
        // Not logged in
        return false;
     }
   } else {
     // Not logged in
     return false;
   }
}

//LOCKED BY BRUTE
function accountLocked($email,$user_id,$mysqli){

//check if there is an activation ID
if ($stmt = $mysqli->prepare("SELECT activationid FROM members WHERE email = ? AND activationid != '' LIMIT 1")) { 
$stmt->bind_param('s', $email); // Bind "$user_id" to parameter.
$stmt->execute(); // Execute the prepared query.
$stmt->store_result();
}
if($stmt->num_rows == 1) 
{	
//use the actid
$stmt->bind_result($actid); // get variables from result.
$stmt->fetch();

}
else
{
//create new

$random_salt = hash('sha512', uniqid(mt_rand(1, mt_getrandmax()), true));
$actid = hash('sha512', $random_salt.$email);
}

if ($update_stmt = $mysqli->prepare("UPDATE members SET isactivated = '0', activationid = ? WHERE email = ?;")) {    
$update_stmt->bind_param('ss',$actid, $email); 
$update_stmt->execute();
}

//send act mail
$to  = $email;
$subject = 'Locked Account on DeckBattle';
$message = '
<html>
<head>
<title>DeckBattle Locked Account Activation</title>
</head>
<body>
<p> After 5 tries your account gets locked. </p>
<p>Here is your activation link to activate your DeckBattle account:</p>
<p><a href="http://www.deckbattle.com/dashboard/login.php?email='. $email.'&activation=' . $actid . '">http://www.deckbattle.com/dashboard/login.php?activation=' . $actid . '</a></p>
<p>Best regards, DeckBattle</p>
<p>If it wasnt you, please contact us</p>
</body>
</html>
';
$headers  = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
$headers .= 'From: DeckBattle <support@deckbattle.com>' . "\r\n";

mail($to, $subject, $message, $headers);

clearBruteForce($user_id,$mysqli);
}

function clearBruteForce($user_id, $mysqli) {
	
	//clear brute force.. Activated id is now leading.		
	if ($delete = $mysqli->prepare("DELETE FROM login_attempts WHERE user_id = ? ;")) {    
	   $delete->bind_param('s',$user_id); 
	   $delete->execute();
	}
}

// ACTIVATION FUNCTION
function activateUser($activation, $mysqli){	
	if ($update_stmt = $mysqli->prepare("UPDATE members SET isactivated = '1', activationid = '' WHERE activationid = ?;")) {    
	   $update_stmt->bind_param('s', $activation); 
	   $update_stmt->execute();
	   
	   return true;
	}		
	
	return false;
}

//SIGNUP FUNCTION
function signup($email, $password_post, $mysqli) {

	$result = "";
	
	if ($select = $mysqli->prepare("SELECT email FROM members WHERE email = '". $email ."';")) { //bad use.. need to refactor with bind param but the @ fails... todo
		$select->execute();
	    $select->store_result();
    	if ($select->num_rows > 0)
		{
			//$result = "exists";
			return false;
			//$error = "This email already exists, try to <a href=\"/dashboard/login.php?email=". $email."\">login</a> or use a different email to sign up. ";
		}

	   $select->close();
	}
	
	if ($result == "")
	{
		$random_salt = hash('sha512', uniqid(mt_rand(1, mt_getrandmax()), true));
		$passwordhash = hash('sha512', $password_post.$random_salt);
		$actid = hash('sha512', $passwordhash.$random_salt.$email);
		
		$username = ''; // not used now
			
		if ($insert_stmt = $mysqli->prepare("INSERT INTO members (username, email, password, salt, activationid) VALUES (?, ?, ?, ?, ?)")) {    
		   $insert_stmt->bind_param('sssss', $username,$email, $passwordhash, $random_salt, $actid); 
		   $insert_stmt->execute();
		   
		   		   
		   //send act mail
			$to  = $email;
			$subject = 'DeckBattle Account Activation';
			$message = '
			<html>
			<head>
			  <title>DeckBattle Account Activation</title>
			</head>
			<body>
			  <p>Here is your activation link to activate your DeckBattle account:</p>
			  <p><a href="http://www.deckbattle.com/dashboard/login.php?email='. $email.'&activation=' . $actid . '">http://www.deckbattle.com/dashboard/login.php?activation=' . $actid . '</a></p>
			  <p>Best regards, DeckBattle</p>
			</body>
			</html>
			';
			$headers  = 'MIME-Version: 1.0' . "\r\n";
			$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
			$headers .= 'From: DeckBattle <support@deckbattle.com>' . "\r\n";
			
			mail($to, $subject, $message, $headers);
			// $result = "success";
		   //$success = "Your account is created using ". $email .". Check your email box quickly to find the activation link!";
		  return true;
		}	
	}
	
	//return $result;
}

function activationmail($email, $mysqli) {
		
     if ($stmt = $mysqli->prepare("SELECT activationid FROM members WHERE email = ? LIMIT 1")) { 
        $stmt->bind_param('s', $email); // Bind "$user_id" to parameter.
        $stmt->execute(); // Execute the prepared query.
        $stmt->store_result();
 
        if($stmt->num_rows == 1) { // If the user exists
           $stmt->bind_result($actid); // get variables from result.
           $stmt->fetch();
		   		   		   
		   //send act mail
			$to  = $email;
			$subject = 'DeckBattle Account Activation';
			$message = '
			<html>
			<head>
			  <title>DeckBattle Account Activation</title>
			</head>
			<body>
			  <p>Here is your activation link to activate your DeckBattle account:</p>
			  <p><a href="http://www.deckbattle.com/dashboard/login.php?email='. $email.'&activation=' . $actid . '">http://www.deckbattle.com/dashboard/login.php?activation=' . $actid . '</a></p>
			  <p>Best regards, DeckBattle</p>
			</body>
			</html>
			';
			$headers  = 'MIME-Version: 1.0' . "\r\n";
			$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
			$headers .= 'From: DeckBattle <support@deckbattle.com>' . "\r\n";
			
			mail($to, $subject, $message, $headers);
			// $result = "success";
		   //$success = "Your account is created using ". $email .". Check your email box quickly to find the activation link!";
		  return true;	
		}
	 }
	return false;
}

function passwordrecovery (	$emailForRecovery, $password_post, $passwordgenerated,$mysqli ) {
	
	if ($emailForRecovery == "")
	{
		
		return false;	
	}
	else
	{
		
		$random_newsalt = hash('sha512', uniqid(mt_rand(1, mt_getrandmax()), true));
		$newpassword = hash('sha512', $password_post.$random_newsalt);

		if ($new = $mysqli->prepare("UPDATE members SET passrecovery = ?, saltrecovery = ? WHERE email = ? and isactivated = 1;")) {    
	   $new->bind_param('sss', $newpassword,$random_newsalt,$emailForRecovery); 
	   $new->execute();
		$new->store_result();
	
		
			$to  = $emailForRecovery;
			$subject = 'DeckBattle Password Recovery';
			$message = '
			<html>
			<head>
			  <title>DeckBattle Password Recovery</title>
			</head>
			<body>
			  <p>Here is your new password for your DeckBattle account:</p>
			  <p>'. $passwordgenerated.'</p>
			  <p>Best regards, DeckBattle - if password recovery was not initiated by you please contact us.</p>
			</body>
			</html>
			';
			$headers  = 'MIME-Version: 1.0' . "\r\n";
			$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
			$headers .= 'From: DeckBattle <support@deckbattle.com>' . "\r\n";
			mail($to, $subject, $message, $headers);
				 return true;
			}
			
			return false;
	
 
 }
}
?>