<?php
include 'db_connect.php';
include 'login_functions.php';

sec_session_start(); // Our custom secure way of starting a php session. 

if(isset($_POST['email'], $_POST['p'])) { 
   $email = $_POST['email'];
   $password = $_POST['p']; // The hashed password.
  //echo $_POST['p'];
 //  echo "<br />" . $_POST['password'];
   if(login($email, $password, $mysqli) == true) {
      // Login success
   //   echo 'Success: You have been logged in!';
      header('Location: /dashboard');

   } else {
      // Login failed
	  // try if the pass recovery is filled.
if(login_rec($email, $password, $mysqli) == true) {
      // Login success
   //   echo 'Success: You have been logged in!';
      header('Location: /dashboard');
}
else
{
      header('Location: ./login.php?error=notcorrect');
   }
   }
} else { 
   // The correct POST variables were not sent to this page.
   echo 'Invalid Request';
}

?>