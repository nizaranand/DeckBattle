<?php
include 'db_connect.php';
include 'login_functions.php';

sec_session_start();

if(login_check($mysqli) != true) {
 
 header('Location: ./login.php?error=notloggedin');
  
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

include './uploadavatar.php';


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />
<title>My Profile - DeckBattle</title>

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

<script type="text/javascript">
<?php
//check passrecovery active > show growl message
if ($_SESSION['passrecoveryactive'] == 1)
{
	echo "var rec = true;";
 }
 else
 {
	echo "var rec = false;";
 }

?>

function finishAjax(id, response) {
  $('#usernameLoading').hide();
  $('#'+id).html(unescape(response));
  $('#'+id).fadeIn();
} //finishAjax



</script> 

<script type="text/javascript" src="js/files/functions.js"></script>

<script type="text/javascript" src="sha512.js"></script>
<script type="text/javascript" src="formhash.js"></script>

<script type="text/javascript" src="js/charts/chart.js"></script>
<script type="text/javascript" src="js/charts/hBar_side.js"></script>


</head>

<body>

<?php include './dashboard_header.php'; ?>
<?php include './dashboard_farleftsidebar.php'; ?>
<?php include './dashboard_leftsidebar.php'; ?>
    
<!-- Content begins -->
<div id="content">
<?php include './dashboard_pageheader.php'; ?>
<?php include './dashboard_breadcrumb.php'; ?>  


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

       <form action="profile.php" method="post" enctype="multipart/form-data" class="main" id="validate">
            <fieldset>
                <div class="widget fluid">
                    <div class="whead"><h6>Account Information</h6><div class="clear"></div></div>
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
                  <div class="grid3"> <label>Avatar:</label></div>
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
                    <div class="whead"><h6>Change Password</h6><div class="clear"></div></div>
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
<?php } ?>