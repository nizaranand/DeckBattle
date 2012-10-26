<?php
include 'db_connect.php';
include 'login_functions.php';

$username = $_POST['username'];
$session_username = $_POST['session_username'];

$username = trim(htmlentities($username)); // strip some crap out of it

	if ($stmt = $mysqli->prepare("SELECT username FROM members WHERE username = ? ;")) { 
		$stmt->bind_param('s', $username); // Bind "$email" to parameter.
		$stmt->execute(); // Execute the prepared query.
		$stmt->store_result();

if($stmt->num_rows >= 1)
{
	if ($username != $session_username)
	{
		echo '<span style="color:#f00">Username Unavailable</span>';
	}
}
else
{
	if ($username != "")
	{
	if (preg_match('/[\'^£$%&*()}{@#~?><>,|=_+¬-]/', $username))
	{
		echo '<span style="color:#f00">Username Unavailable, you have invalid characters. Please use letters and numbers only.</span>';
	}
	else
	{
	echo '<span style="color:#0c0">Username Available</span>';	
	}
	}
}
		
}
?>