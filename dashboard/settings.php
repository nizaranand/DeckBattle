<?php
set_include_path($_SERVER['DOCUMENT_ROOT']);

include  'dashboard/include/db_connect.php';
include  'dashboard/include/login_functions.php';

sec_session_start();

if(login_check($mysqli) != true) {
 
 header('Location: http://www.deckbattle.com/dashboard/login.php?error=notloggedin');
  
} else {

$error = "";
$error2 = "";
$success = "";
$success2 = "";
$password_post = "";
$password_check = "";

if (isset($_POST['pcheck']))
{
	if ($_POST['pcheck'] == "")
	{
	 	$error = "Oh no, you forgot to retype your password!";
	}
	else {
		$password_check = $_POST['pcheck']; 
	}
}

	
if (isset($_POST['p']))
{
	if ($_POST['p'] == "")
	{
	 	$error = "Oh no, you forgot to fill in a password. We really need one otherwise everyone can access your account. And you don't want that!";
	}
	else {
		$password_post = $_POST['p']; 
	}
}


	//CHANGE PASS
if ($password_post != "" && $password_check != "" && isset($_POST['changepass'])) {
	if ($password_check == $password_post)
		{
		
		$isChanged = changepass($_SESSION['user_id'],$password_post,$mysqli);

		if ($isChanged)
		{
			$success = "Your password has been changed.";
			$_SESSION['passrecoveryactive'] = 0;
		}
		else
		{
			$error = "Hmm, not good. Something went wrong. Please try again or contact us if the problem persists.";
		}
	}
	else
	{
		$error = "Hmm, not good. You didn't retype your password correctly.";
	}
}

//CHANGE INFO
if (isset($_POST['changeinfo']))
{
	if (isset($_POST['username']) && $_POST['username'] != $_SESSION['username'])
	{
		
		$isUsernameChanged = changeusername($_SESSION['user_id'],$_POST['username'], $mysqli);	
		if ($isUsernameChanged)
			$success = "Username has been changed";
		else
			$error = "Username has not been changed, it is probably already taken. Please try again.";
	}

	if (isset($_POST['email']) && $_POST['email'] != $_SESSION['email'])
	{
		$isEmailChanged = changeemail($_SESSION['user_id'],$_POST['email'], $mysqli);	
		if ($isEmailChanged)
		 	if ($success == "")
				$success = "Email has been changed. Please check your email box for activation, only when activated it will be changed permanantly.";
				else
				$success2 = "Email has been changed. Please check your email box for activation, only when activated it will be changed permanantly.";
		else
			if ($error == "")
			$error = "Email has not been changed.";
			else
			$error2 = "Email has not been changed.";
	}
}


	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />
<title>DeckBattle Dashboard</title>

<link href="css/styles.css" rel="stylesheet" type="text/css" />
<!--[if IE]> <link href="css/ie.css" rel="stylesheet" type="text/css"> <![endif]-->


<?php include 'dashboard/include/script_include.php'; ?>

<script>
$(function() {
$("select, .check, .check :checkbox, input:radio, input:file").uniform();

});
</script>
</head>

<body>

<?php include 'dashboard/include/dashboard_header.php'; ?>
<?php include 'dashboard/include/dashboard_farleftsidebar.php'; ?>


<?php include 'dashboard/include/dashboard_leftsidebar.php'; ?>
    
<!-- Content begins -->
<div id="content">
<?php include 'dashboard/include/dashboard_pageheader.php'; 
createPageHeader("Settings",$mysqli);
?>
<?php include 'dashboard/include/dashboard_breadcrumb.php';
generateBreadcrumb("Dashboard","Settings");
 ?>  
 
    <!-- Main content -->
    <div class="wrapper">
   <?php 
if ($success != "")
{
	?>
<div class="nNote nSuccess">
<p><?php echo $success;?></p>
</div>
<?php 
}

if ($success2 != "")
{
	?>
<div class="nNote nSuccess">
<p><?php echo $success2;?></p>
</div>
<?php 
}

if ($error != "")
{
?>
<div class="nNote nFailure">
<p><?php echo $error;?></p>
</div>
<?php } 
if ($error2 != "")
{
?>
<div class="nNote nFailure">
<p><?php echo $error2;?></p>
</div>
<?php } 

$success = "";
$success2 = "";
$error = ""; 
$error2 = ""; 

?>

       <form action="settings.php" class="main" method="post" id="validate">
            <fieldset>
                <div class="widget fluid">
                    <div class="whead"><h6>Settings</h6>
                    <div class="clear"></div>
                </div>
                
                   </fieldset>
            </fieldset>
           </form>
    </div>
</div>
<!-- Content ends -->  

</body>
</html>
<?php } ?>