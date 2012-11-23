<?php
set_include_path($_SERVER['DOCUMENT_ROOT']);

require_once 'dashboard/include/db_connect.php';
require_once 'dashboard/include/login_functions.php';

sec_session_start();

//ini
$success = "";
$error = "";

$email_get = $_GET['email'];
$passwordgenerated = $_POST['pgen'];
$password_post = "";
$email_post = "";

//REMEMBER ME
if ($_COOKIE["DeckBattleRememberMe"] != "") {
    if ($email_get == "")
        $email_get = $_COOKIE["DeckBattleRememberMe"];
} 

//LOGOUT
if (isset($_GET['logout'])) {
    $_SESSION = array();
    // Unset all session values
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000, $params["path"], $params["domain"], $params["secure"], $params["httponly"]);
    // Delete the actual cookie.
    session_destroy();

    $success = "You are logged out from the DeckBattle Dashboard. See you next time!";

}

//POSTS HANDLERS
if (isset($_POST['p'])) {
    if ($_POST['p'] == "") {
        $error = "Oh no, you forgot to fill in a password. We really need one otherwise everyone can access your account. And you don't want that!";
    } else {
        $password_post = $_POST['p'];
    }
}

if (isset($_POST['email'])) {
    if ($_POST['email'] == "") {
        $error = "Oh no, you forgot to fill in an email address. Without one, we cannot create an DeckBattle account.";
    } else {

        if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
            $error = "This email address: " . $_POST['email'] . " is not valid. Please fill in a correct email address.";
        } else {
            $email_post = $_POST['email'];
        }
    }
}

//ACTIVATE ACCOUNT
if (isset($_GET['activation']) && $_GET['activation'] != "") {
    $isactivated = activateUser($_GET['activation'], $mysqli);

    if ($isactivated)
        $success = "Account activated, you can login now!";
    else
        $error = "Something went wrong. Not a valid activation link.";
}

//ACTIVATE NEW EMAIL
if (isset($_GET['emailactivation']) && $_GET['emailactivation'] != "") {
    $isemailactivated = activateEmail($_GET['emailactivation'], $mysqli);

    if ($isemailactivated)
        $success = "New email activated, you can login now with your new email address!";
    else
        $error = "Something went wrong. Not a valid activation link.";
}

//REQUEST NEW ACTIVATION EMAIL
if (isset($_GET['request']) && $_GET['request'] != "") {
    $isactivatedmailsent = activationmail($_GET['request'], $mysqli);

    if ($isactivatedmailsent)
        $success = "Activation email send to: " . $_GET['request'] . ", please check your SPAM email box if you don't recieve the mail. Still having problems, contact us.";
    else
        $error = "Something went wrong. Not a valid activation request.";
}

//SIGNUP
if ($password_post != "" && $email_post != "" && isset($_GET['action'])) {

    $isSignedUp = signup($email_post, $password_post, $mysqli);

    if ($isSignedUp) {
        $success = "Your account is created using " . $email_post . ". Check your email box quickly to find the activation link!";
    } else {
        $error = "This email already exists, try to <a href=\"/dashboard/login.php?email=" . $email_post . "\">login</a> or use a different email to sign up. ";
    }
}

//PASSWORD RECOVERY
if (isset($_POST['passwordrecovery'])) {

    $isPassrecovered = passwordrecovery($_POST['passwordrecovery'], $password_post, $passwordgenerated, $mysqli);

    if ($isPassrecovered) {
        $success = "Your new password has been mailed to: " . $_POST['passwordrecovery'] . ". Check your email box quickly to get your new password.";
    } else {
        $error = "We can't find your email, are you sure you filled in the right one? Or your account isn't activated yet, <a href=\"login.php?request=" . $_POST['passwordrecovery'] . "\" > Click here and we will send you a new activation email to: " . $_POST['passwordrecovery'] . ".</a>.";
    }
}

//ERRORS THROUGH GET
if (isset($_GET['error'])) {
    $temp = $_GET['error'];

    if ($temp == 'notloggedin')
        $error = 'You have to login to access the DeckBattle Dashboard. Please fill in your email and password, or <a href="?action=signup">sign up</a> for a free account.';
    if ($temp == 'notcorrect')
        $error = 'Email and/or password are not correct, please try again. If you just created your account please check your activation mail, or <a href="login.php?request=' . $email_get . '" >request a new one</a>.';

}
?>
<!doctype html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />
<title>DeckBattle Login & Sign up!</title>

<link href="css/styles.css" rel="stylesheet" type="text/css" />
<!--[if IE]> <link href="css/ie.css" rel="stylesheet" type="text/css"> <![endif]-->

<?php
require_once 'dashboard/include/script_include.php';
?>

<script type="text/javascript" src="js/files/login.js"></script>

<script type="text/javascript" src="js/crypto/sha512.js"></script>
<script type="text/javascript" src="js/crypto/formhash.js"></script>

<script>
	$(function() {
		$("select, .check, .check :checkbox, input:radio, input:file").uniform();

	}); 
</script>
</head>

<body>

<!-- Top line begins -->
<div id="top">
<div class="wrapper">
<a href="login.php" title="Login" class="logo"><img src="images/DeckBattle_Inverted_small.png" alt="Deckbattle Dashboard" /></a>

<div class="clear"></div>

<?php
if ($success != "")
{
?>
<div class="nNote nSuccess">
<p><?php echo $success;
    $success = "";
    $error = "";
?>
</p>
</div>
<?php
}
if ($error != "")
{
?>
<div class="nNote nFailure">
<p><?php echo $error;
    $success = "";
    $error = "";
?>
</p>
</div>
<?php
}
?>
</div>
</div>
<!-- Top line ends -->

<div class="loginWrapper">
<?php
if (isset($_GET['action']) && $_GET['action'] == "signup")
{
?>
<form action="login.php?action=signup" method="post" id="login">
<div class="loginPic">
<img src="images/DeckBattle_login.png" alt="Sign up!" />
<span>Sign up</span>
<div class="loginActions">
<div><a href="#" title="Login" class="logback flip tipE"></a></div>
</div>
</div>

<input type="text" data-prompt-position="centerRight" name="email" placeholder="Your email address" id="email" class="validate[required,custom[email]]" value="<?php echo $email_get; ?>" />
<input data-prompt-position="centerRight" class="validate[required,custom[onlyLetterNumber]]" type="text" name="username" id="username" placeholder="Your username" />
<input data-prompt-position="centerRight" type="password" name="password" id="password" placeholder="Password" class="validate[required,minSize[6]]" />
<input type="hidden" name="signup" value="true" />
<div class="logControl">
<input type="submit" name="submitSignup" value="Sign up!" class="buttonM bGreen" onclick="formhash(this.form, this.form.password);" />
<div class="clear"></div>
<div style="padding-top:10px;"><a href="/">- Back to Deckbattle.com -</a></div>
</div>
</form>

<form action="./services/process_login.php" method="post" name="login_form" id="recover" >
<div class="loginPic">
<img src="images/DeckBattle_login.png" alt="" />
<span>Login</span>
<div class="loginActions">
<div><a href="#" title="Sign up!" class="logleft flip tipE"></a></div>
<div><a id="formDialogPassRecovery_open" href="#" title="Forgot password?" class="logright tipW"></a></div>
</div>
</div>

<input type="text" name="email" placeholder="Your email address" class="loginEmail" value="<?php echo $email_get; ?>" />
<input type="password" name="password" id="password" placeholder="Password" class="loginPassword" />

<div class="logControl">
<div class="memory"><input type="checkbox" checked="checked" class="check" id="remember1" name="remember1" value="rememberme" /><label for="remember1">Remember me</label></div>
<input type="submit" name="submitLogin" value="Login" class="buttonM bBlue" onclick="formhash(this.form, this.form.password);" />

<div class="clear"></div>
<div style="padding-top:10px;"><a href="/">- Back to Deckbattle.com -</a></div>
</div>
</form>

<?php
}
else
{
?>
<form action="./services/process_login.php" method="post" name="login_form" id="login">
<div class="loginPic">
<img src="images/DeckBattle_login.png" alt="Login" />
<span>Login</span>
<div class="loginActions">
<div><a href="#" title="Sign up!" class="logleft flip tipE"></a></div>
<div><a id="formDialogPassRecovery_open" href="#" title="Forgot password?" class="logright tipW"></a></div>
</div>
</div>

<input type="text" name="email" placeholder="Your email address" class="loginEmail" value="<?php echo $email_get; ?>" />
<input type="password" name="password" id="password" placeholder="Password" class="loginPassword" />

<div class="logControl">
<div class="memory"><input type="checkbox" checked="checked" class="check" id="remember1" name="remember1" value="rememberme" /><label for="remember1">Remember me</label></div>
<input type="submit" name="submitLogin" value="Login" class="buttonM bBlue" onclick="formhash(this.form, this.form.password);" />

<div class="clear"></div>
<div style="padding-top:10px;"><a href="/">- Back to Deckbattle.com -</a></div>
</div>
</form>

<form action="login.php?action=signup" method="post" id="recover"> <!-- signup form -->
<div class="loginPic">
<img src="images/DeckBattle_login.png" alt="Sign up!" />
<span>Sign up</span>
<div class="loginActions">
<div><a href="#" title="Login" class="logback flip tipE"></a></div>
</div>
</div>

<input data-prompt-position="centerRight" type="text" name="email" placeholder="Your email address" id="email" class="validate[required,custom[email]]" value="<?php echo $email_get; ?>">
<input  data-prompt-position="centerRight" class="validate[required,custom[onlyLetterNumber]]" type="text" name="username" id="username" placeholder="Your username" />
<input data-prompt-position="centerRight" type="password" name="password" id="password" placeholder="Password" class="validate[required,minSize[6]]" />
<input type="hidden" name="signup" value="true" />
<div class="logControl">
<!--  <div class="memory"><input type="checkbox" checked="checked" class="check" id="remember2" /><label for="remember2">Remember me</label></div> -->
<input type="submit" name="submitSignup" value="Sign up!" class="buttonM bGreen" onclick="formhash(this.form, this.form.password);" />

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
<input type="text" name="passwordrecovery" class="clear" style="width:250px;" placeholder="Enter your email address" />
<input type="submit" name="submit" value="Email a new password" class="buttonM bBlue" onclick="formhashrecovery(this.form);"/>
</form>
</div>
</body>
</html>
