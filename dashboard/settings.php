<?php
set_include_path($_SERVER['DOCUMENT_ROOT']);
require_once 'dashboard/include/base_include.php';

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

require_once 'dashboard/services/uploadavatar.php';


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />
		<title>DeckBattle</title>
		<link href="/dashboard/css/styles.css" rel="stylesheet" type="text/css" />
		<!--[if IE]> <link href="/dashboard/css/ie.css" rel="stylesheet" type="text/css"> <![endif]-->
<?php
	require_once 'dashboard/include/script_include.php';
 ?>

<script type="text/javascript" src="js/files/login.js"></script>
<script type="text/javascript" src="js/crypto/sha512.js"></script>
<script type="text/javascript" src="js/crypto/formhash.js"></script>

<script type="text/javascript">
	$(function() {
		$('#usernameLoading').hide();

		$('#username').keyup(function() {
			$('#usernameLoading').show();
			$.post("./services/usernamecheck.php", {
				username : $('#username').val(),
				session_username : $('#session_username').val()
			}, function(response) {
				$('#usernameResult').fadeOut();
				setTimeout("finishAjax('usernameResult', '" + escape(response) + "')", 400);
			});

			return false;
		});
	});

	function finishAjax(id, response) {
		$('#usernameLoading').hide();
		$('#' + id).html(unescape(response));
		$('#' + id).fadeIn();

	}//finishAjax

	$(function() {
		$("select, .check, .check :checkbox, input:radio, input:file").uniform();

	}); 
</script> 
</head>

<body>
<?php
	require_once 'dashboard/include/dashboard_header.php';
	require_once 'dashboard/include/dashboard_farleftsidebar.php';
	require_once 'dashboard/include/dashboard_leftsidebar.php';
 ?>
    
<!-- Content begins -->
<div id="content">
<?php
	require_once 'dashboard/include/dashboard_pageheader.php';
	createPageHeader("Profile", $mysqli);
	require_once 'dashboard/include/dashboard_breadcrumb.php';
	generateBreadcrumb("Dashboard", "Profile");
 ?>  
 
    <!-- Main content -->
    <div class="wrapper">
<?php include  'dashboard/include/messages.php'; ?>
       <form action="profile.php" method="post" enctype="multipart/form-data" class="main" id="validate">
            <fieldset>
                <div class="widget fluid">
                    <div class="whead"><h6>Dropbox</h6><div class="clear"></div></div>
                    <div class="formRow">
                        <div class="grid3"><label>Username:</label></div>
                        <div class="grid9"><input data-prompt-position="topLeft" class="validate[required,custom[onlyLetterNumber]]" type="text" name="username" id="username" value="<?php echo $_SESSION['username']; ?>" /><input type="hidden" name="session_username" id="session_username" value="<?php echo $_SESSION['username']; ?>" /></div>
                        <div><span id="usernameLoading"><img src="/dashboard/images/elements/loaders/10s.gif" alt="Ajax Indicator" /></span>
						<span id="usernameResult"></span></div>
                        <div class="clear"></div>
                        
                    </div>
                    <div class="formRow">
                        <div class="grid3"><label>Email:</label></div>
                        <div class="grid9"><input type="text" data-prompt-position="topLeft" class="validate[required,custom[email]]" name="email" id="email" value="<?php echo $_SESSION['email']; ?>" /></div>
                        <div class="clear"></div>
                    </div>
                   <div class="formRow">
                  <div class="grid3"> <label>New Avatar:</label></div>
                   <div class="grid9"> <input type="file" class="fileInput" id="ImageFile" name="ImageFile" /><input type="hidden" name="MAX_FILE_SIZE" value="500000" /></div>
                   <div id="output"></div>

                       <div class="clear"></div>
                 </div>
                    <div class="formRow">
	                    <input class="buttonM bBlack formSubmit" type="submit" name="changeinfo" id="submitinfo" value="Update Account Information">
                    	<div class="clear"></div>
                    </div>
                   </div>
          
                <div class="widget fluid">
                    <div class="whead"><h6>DeckBattle</h6><div class="clear"></div></div>
                    <div class="formRow">
                        <div class="grid3"><label>New Password</label></div>
                        <div class="grid9"><input id="password" data-prompt-position="topLeft" class="validate[minSize[6]]" type="password" name="password" /></div>
                        <div class="clear"></div>
                    </div>
                     <div class="formRow">
                        <div class="grid3"><label>Re-type Password:</label></div>
                        <div class="grid9"><input type="password" data-prompt-position="topLeft" name="password2" id="password2" class="validate[minSize[6]]" /></div>
                        <div class="clear"></div>
                    </div>
                  	<div class="formRow">
						<input class="buttonM bBlack formSubmit" id="submitpass" type="submit" name="changepass" value="Change Password" onclick="formchangepass(this.form, this.form.password,this.form.password2);">
						<div class="clear"></div>
					</div>  
                </div>
            </fieldset>
           </form>
    </div>
</div>
<!-- Content ends -->  
</body>
</html>