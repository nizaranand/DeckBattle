<?php
include 'db_connect.php';
include 'login_functions.php';

sec_session_start(); // Our custom secure way of starting a php session. 

if(isset($_POST['email'], $_POST['p'])) { 
   $email = $_POST['email'];
   $password = $_POST['p']; // The hashed password.
  
   if(login($email, $password, $mysqli) == true) {
	   if (isset($_POST['remember1']))
		{
			setcookie( "DeckBattleRememberMe", $email, strtotime( '+3300 days' ) );
		}
		else
		{
			setcookie('DeckBattleRememberMe', $email, 1);
		}
   //echo 'login cool, to the dash!!<br />';
      header('Location: /dashboard');
   } 
   else
	{
      header('Location: ./login.php?error=notcorrect');
  	}
  
} else { 
   // The correct POST variables were not sent to this page.
   echo 'Invalid Request';
}

?>