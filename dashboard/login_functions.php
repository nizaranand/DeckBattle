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
			  
			  //check if a recovery pass is active
			   if ($stmt = $mysqli->prepare("SELECT passrecovery FROM members WHERE id = ? LIMIT 1")) { 
				$stmt->bind_param('i', $user_id); // Bind "$user_id" to parameter.
				$stmt->execute(); // Execute the prepared query.
				$stmt->store_result();
		 		
					if($stmt->num_rows == 1) 
					{
						 $_SESSION['passrecoveryactive'] = 1;
					}
			   }
			  
              return true;
           } 
		   else {
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
?>