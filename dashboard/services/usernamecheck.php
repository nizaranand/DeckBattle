<?php //TODO:json result
set_include_path($_SERVER['DOCUMENT_ROOT']);
require_once 'dashboard/include/db_connect.php';

$username = $_POST['username'];
$session_username = $_POST['session_username'];

$username = trim(htmlentities($username));

if ($stmt = $mysqli -> prepare("SELECT username FROM members WHERE username = ? ;")) {
	$stmt -> bind_param('s', $username);
	$stmt -> execute();
	$stmt -> store_result();

	if ($stmt -> num_rows >= 1) {
		if ($username != $session_username) {
			echo '<span style="color:#f00">Username Unavailable</span>';
		}
	} else {
		if ($username != "") {
			if (preg_match('/[\'^£$%&*()}{@#~?><>,|=_+¬-]/', $username)) {
				echo '<span style="color:#f00">Username Unavailable, you have invalid characters. Please use letters and numbers only.</span>';
			} else {
				echo '<span style="color:#0c0">Username Available</span>';
			}
		}
	}
}
?>