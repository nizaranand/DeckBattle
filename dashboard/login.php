<?php
include 'db_connect.php';
include 'login_functions.php';

$success = "";
$error = "";

$email_get = $_GET['email'];
$email = $_POST['email'];
$password_post = $_POST['p']; 
$passwordgenerated = $_POST['pgen']; 

sec_session_start();

if ($_COOKIE["DeckBattleRememberMe"] != "")
{
$email_get = $_COOKIE["DeckBattleRememberMe"];
}


if (isset($_GET['logout']))
{
	
// Unset all session values
$_SESSION = array();
// get session parameters 
$params = session_get_cookie_params();
// Delete the actual cookie.
setcookie(session_name(), '', time() - 42000, $params["path"], $params["domain"], $params["secure"], $params["httponly"]);
// Destroy session
session_destroy();

$success = "You are logged out from the DeckBattle Dashboard. See you next time!";
	
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />
<title>DeckBattle Login & Sign up!</title>

<link href="css/styles.css" rel="stylesheet" type="text/css" />
<!--[if IE]> <link href="css/ie.css" rel="stylesheet" type="text/css"> <![endif]-->

<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7/jquery.min.js"></script>

<script type="text/javascript" src="js/plugins/forms/ui.spinner.js"></script>
<script type="text/javascript" src="js/plugins/forms/jquery.mousewheel.js"></script>
 
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/jquery-ui.min.js"></script>

<script type="text/javascript" src="js/plugins/charts/excanvas.min.js"></script>
<script type="text/javascript" src="js/plugins/charts/jquery.flot.js"></script>
<script type="text/javascript" src="js/plugins/charts/jquery.flot.orderBars.js"></script>
<script type="text/javascript" src="js/plugins/charts/jquery.flot.pie.js"></script>
<script type="text/javascript" src="js/plugins/charts/jquery.flot.resize.js"></script>
<script type="text/javascript" src="js/plugins/charts/jquery.sparkline.min.js"></script>

<script type="text/javascript" src="js/plugins/tables/jquery.dataTables.js"></script>
<script type="text/javascript" src="js/plugins/tables/jquery.sortable.js"></script>
<script type="text/javascript" src="js/plugins/tables/jquery.resizable.js"></script>

<script type="text/javascript" src="js/plugins/forms/autogrowtextarea.js"></script>
<script type="text/javascript" src="js/plugins/forms/jquery.uniform.js"></script>
<script type="text/javascript" src="js/plugins/forms/jquery.inputlimiter.min.js"></script>
<script type="text/javascript" src="js/plugins/forms/jquery.tagsinput.min.js"></script>
<script type="text/javascript" src="js/plugins/forms/jquery.maskedinput.min.js"></script>
<script type="text/javascript" src="js/plugins/forms/jquery.autotab.js"></script>
<script type="text/javascript" src="js/plugins/forms/jquery.chosen.min.js"></script>
<script type="text/javascript" src="js/plugins/forms/jquery.dualListBox.js"></script>
<script type="text/javascript" src="js/plugins/forms/jquery.cleditor.js"></script>
<script type="text/javascript" src="js/plugins/forms/jquery.ibutton.js"></script>
<script type="text/javascript" src="js/plugins/forms/jquery.validationEngine-en.js"></script>
<script type="text/javascript" src="js/plugins/forms/jquery.validationEngine.js"></script>

<script type="text/javascript" src="js/plugins/uploader/plupload.js"></script>
<script type="text/javascript" src="js/plugins/uploader/plupload.html4.js"></script>
<script type="text/javascript" src="js/plugins/uploader/plupload.html5.js"></script>
<script type="text/javascript" src="js/plugins/uploader/jquery.plupload.queue.js"></script>

<script type="text/javascript" src="js/plugins/wizards/jquery.form.wizard.js"></script>
<script type="text/javascript" src="js/plugins/wizards/jquery.validate.js"></script>
<script type="text/javascript" src="js/plugins/wizards/jquery.form.js"></script>

<script type="text/javascript" src="js/plugins/ui/jquery.collapsible.min.js"></script>
<script type="text/javascript" src="js/plugins/ui/jquery.breadcrumbs.js"></script>
<script type="text/javascript" src="js/plugins/ui/jquery.tipsy.js"></script>
<script type="text/javascript" src="js/plugins/ui/jquery.progress.js"></script>
<script type="text/javascript" src="js/plugins/ui/jquery.timeentry.min.js"></script>
<script type="text/javascript" src="js/plugins/ui/jquery.colorpicker.js"></script>
<script type="text/javascript" src="js/plugins/ui/jquery.jgrowl.js"></script>
<script type="text/javascript" src="js/plugins/ui/jquery.fancybox.js"></script>
<script type="text/javascript" src="js/plugins/ui/jquery.fileTree.js"></script>
<script type="text/javascript" src="js/plugins/ui/jquery.sourcerer.js"></script>

<script type="text/javascript" src="js/plugins/others/jquery.fullcalendar.js"></script>
<script type="text/javascript" src="js/plugins/others/jquery.elfinder.js"></script>

<script type="text/javascript" src="js/plugins/ui/jquery.easytabs.min.js"></script>
<script type="text/javascript" src="js/files/bootstrap.js"></script>
<script type="text/javascript" src="js/files/login.js"></script>
<script type="text/javascript" src="js/files/functions.js"></script>

<script type="text/javascript" src="sha512.js"></script>
<script type="text/javascript" src="formhash.js"></script>

</head>

<body>

<?php

// ACTIVATION FUNCTION
if (isset($_GET['activation']))
{
	$actid = $_GET['activation'];	
	if ($actid != "")
	{
	
	if ($update_stmt = $mysqli->prepare("UPDATE members SET isactivated = '1' WHERE activationid = ?;")) {    
	   $update_stmt->bind_param('s', $actid); 
	   $update_stmt->execute();
	}		
	
	$success = "Account activated, you can login now!";
	}
}



//SIGNUP FUNCTION
if (isset($_POST['signup']))
{
	
	if ($select = $mysqli->prepare("SELECT email FROM members WHERE email = '". $email ."';")) { //bad use.. need to refactor with bind param but the @ fails... todo
		$select->execute();
	    $select->store_result();
    	if ($select->num_rows > 0)
		{
			$error = "This email already exists, try to <a href=\"/dashboard/login.php?email=". $email."\">login</a> or use a different email to sign up. ";
		}

	   $select->close();
	}
	
	if ($error == "")
	{
		$random_salt = hash('sha512', uniqid(mt_rand(1, mt_getrandmax()), true));
		$passwordhash = hash('sha512', $password_post.$random_salt);
		$actid = hash('sha512', $passwordhash.$random_salt.$email);
		
		$username = ''; // not used now
			
		if ($insert_stmt = $mysqli->prepare("INSERT INTO members (username, email, password, salt, activationid) VALUES (?, ?, ?, ?, ?)")) {    
		   $insert_stmt->bind_param('sssss', $username,$email, $passwordhash, $random_salt, $actid); 
		   $insert_stmt->execute();
		   
		   $success = "Your account is created using ". $email .". Check your email box quickly to find the activation link!";
		   
		   //send act mail
			$to  = $email;
			
			// subject
			$subject = 'DeckBattle Account Activation';
			
			// message
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
			
			// To send HTML mail, the Content-type header must be set
			$headers  = 'MIME-Version: 1.0' . "\r\n";
			$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
			
			// Additional headers
			//$headers .= 'To: Mary <mary@example.com>, Kelly <kelly@example.com>' . "\r\n";
			$headers .= 'From: DeckBattle <support@deckbattle.com>' . "\r\n";
			
			// Mail it
			mail($to, $subject, $message, $headers);
		   
		}	
	}
}

if (isset($_POST['passwordrecovery'])){
	
	 	$emailForRecovery = $_POST['passwordrecovery'];

		$random_newsalt = hash('sha512', uniqid(mt_rand(1, mt_getrandmax()), true));
		$newpassword = hash('sha512', $password_post.$random_newsalt);

	if ($update_stmt = $mysqli->prepare("UPDATE members SET passrecovery = ?, saltrecovery = ? WHERE email = ?;")) {    
	   $update_stmt->bind_param('sss', $newpassword,$random_newsalt,$emailForRecovery); 
	   $update_stmt->execute();
	}		

		   $success = "Your new password has been mailed to: ". $emailForRecovery .". Check your email box quickly to get your new password.";
		   
		   //send act mail
			$to  = $emailForRecovery;
			
			// subject
			$subject = 'DeckBattle Password Recovery';
			
			// message
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
			
			// To send HTML mail, the Content-type header must be set
			$headers  = 'MIME-Version: 1.0' . "\r\n";
			$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
			
			// Additional headers
			//$headers .= 'To: Mary <mary@example.com>, Kelly <kelly@example.com>' . "\r\n";
			$headers .= 'From: DeckBattle <support@deckbattle.com>' . "\r\n";
			
			// Mail it
			mail($to, $subject, $message, $headers);
 
 }



if(isset($_GET['error'])) { 

$temp = $_GET['error'];

if ($temp == 'notloggedin')
   $error = 'You have to login to access the DeckBattle Dashboard. Please fill in your email and password, or <a href="?action=signup">sign up</a> for a free account.';
if ($temp == 'notcorrect')
   $error = 'Email and/or password are not correct, please try again. If you just created your account please check your activation mail, or <a href="login.php?request='. $email . '" >request a new one</a>.';

}
?>


<!-- Top line begins -->
<div id="top">
	<div class="wrapper">
    	<a href="#" title="" class="logo"><img src="images/DeckBattle_Inverted_small.png" alt="" /></a>
        
        <!-- Right top nav -->
        <div class="topNav">
            <ul class="userNav">
                <li><a href="#" title="" class="screen"></a></li>
                <li><a href="#" title="" class="settings"></a></li>
                <li><a href="#" title="" class="logout"></a></li>
            </ul>
        </div>
        <div class="clear"></div>

<?php 
if ($success != "")
{
	?>
<div class="nNote nSuccess">
<p><?php echo $success; $success = "";$error = ""; ?></p>
</div>
<?php 
}
if ($error != "")
{
?>
<div class="nNote nFailure">
<p><?php echo $error; $success = "";$error = ""; ?></p>
</div>
<?php } ?>
    </div>
</div>
<!-- Top line ends -->


<!-- Login wrapper begins -->
<div class="loginWrapper">
<?php 
if (isset($_GET['action']))
{
?>
	  
    <!-- New user form -->
    <form action="login.php?action=signup" method="post" id="login"> <!-- signup form -->
        <div class="loginPic">
            <a href="#" title=""><img src="images/DeckBattle_login.png" alt="" /></a>
            <span>Sign up</span>
            <div class="loginActions">
                <div><a href="#" title="Login" class="logback flip tipE"></a></div>
<!--                <div><a href="#" title="Forgot password?" class="logright tipW"></a></div> -->
            </div>
        </div>
            
        <input type="text" name="email" placeholder="Your email address" class="loginUsername" value="<?php echo $email_get;?>" />
        <input type="password" name="password" placeholder="Password" class="loginPassword" />
        <input type="hidden" name="signup" value="true" />
        <div class="logControl">
          <!--  <div class="memory"><input type="checkbox" checked="checked" class="check" id="remember2" /><label for="remember2">Remember me</label></div> -->
            <input type="submit" name="submit" value="Sign up!" class="buttonM bBlue" onclick="formhash(this.form, this.form.password);" />
         
              <div class="clear"></div>
            <div style="padding-top:10px;"><a href="/">- Back to Deckbattle.com -</a></div>
        </div>
    </form>

    <!-- Current user form -->
<form action="process_login.php" method="post" name="login_form" id="recover" >
        <div class="loginPic">
            <a href="#" title=""><img src="images/DeckBattle_login.png" alt="" /></a> <!-- if remember me, use avatar -->
            <span>Login</span> <!-- if remember me on > your name and avaar -->
            <div class="loginActions">
                <div><a href="#" title="Sign up!" class="logleft flip tipE"></a></div>
                <div><a id="formDialogPassRecovery_open" href="#" title="Forgot password?" class="logright tipW"></a></div>
            </div>
        </div>
        
        <input type="text" name="email" placeholder="Your email address" class="loginEmail" value="<?php echo $email_get;?>" />
        <input type="password" name="password" id="password" placeholder="Password" class="loginPassword" />
        
        <div class="logControl">
            <div class="memory"><input type="checkbox" checked="checked" class="check" id="remember1" name="remember1" value="rememberme" /><label for="remember1">Remember me</label></div>
            <input type="submit" name="submit" value="Login" class="buttonM bBlue" onclick="formhash(this.form, this.form.password);" />
          
             <div class="clear"></div>
           <div style="padding-top:10px;"><a href="/">- Back to Deckbattle.com -</a></div>
        </div>
    </form>
  
<?php
}
else
{
	?>
	<!-- Current user form -->
<form action="process_login.php" method="post" name="login_form" id="login">
        <div class="loginPic">
            <a href="#" title=""><img src="images/DeckBattle_login.png" alt="" /></a> <!-- if remember me, use avatar -->
            <span>Login</span> <!-- if remember me on > your name and avaar -->
            <div class="loginActions">
                <div><a href="#" title="Sign up!" class="logleft flip tipE"></a></div>
                <div><a id="formDialogPassRecovery_open" href="#" title="Forgot password?" class="logright tipW"></a></div>
            </div>
        </div>
        
        <input type="text" name="email" placeholder="Your email address" class="loginEmail" value="<?php echo $email_get;?>" />
        <input type="password" name="password" id="password" placeholder="Password" class="loginPassword" />
        
        <div class="logControl">
            <div class="memory"><input type="checkbox" checked="checked" class="check" id="remember1" name="remember1" value="rememberme" /><label for="remember1">Remember me</label></div>
            <input type="submit" name="submit" value="Login" class="buttonM bBlue" onclick="formhash(this.form, this.form.password);" />
          
             <div class="clear"></div>
           <div style="padding-top:10px;"><a href="/">- Back to Deckbattle.com -</a></div>
        </div>
    </form>
    
    <!-- New user form -->
    <form action="login.php?action=signup" method="post" id="recover"> <!-- signup form -->
        <div class="loginPic">
            <a href="#" title=""><img src="images/DeckBattle_login.png" alt="" /></a>
            <span>Sign up</span>
            <div class="loginActions">
                <div><a href="#" title="Login" class="logback flip tipE"></a></div>
<!--                <div><a href="#" title="Forgot password?" class="logright tipW"></a></div> -->
            </div>
        </div>
            
        <input type="text" name="email" placeholder="Your email address" class="loginUsername" value="<?php echo $email_get;?>">
        <input type="password" name="password" placeholder="Password" class="loginPassword" />
        <input type="hidden" name="signup" value="true" />
        <div class="logControl">
          <!--  <div class="memory"><input type="checkbox" checked="checked" class="check" id="remember2" /><label for="remember2">Remember me</label></div> -->
            <input type="submit" name="submit" value="Sign up!" class="buttonM bBlue" onclick="formhash(this.form, this.form.password);" />
         
              <div class="clear"></div>
            <div style="padding-top:10px;"><a href="/">- Back to Deckbattle.com -</a></div>
        </div>
    </form>
<?php
}
?>
</div>
<!-- Login wrapper ends -->
                <!-- Dialog content -->
                        <div id="formDialogPassRecovery" class="dialog" title="Password recovery" style="text-align:center;">
                            <form id="passwordrecoveryform" action="login.php" method="post">
                            <!--<label>Your email:</label>-->
                                <input type="text" name="passwordrecovery" class="clear" style="width:250px;" placeholder="Enter your email address" />
                                <input type="submit" name="submit" value="Email a new password" class="buttonM bBlue" onclick="formhashrecovery(this.form);"/>
                            </form>
                        </div>

</body>
</html>
