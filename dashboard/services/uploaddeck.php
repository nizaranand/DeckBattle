<?php
set_include_path($_SERVER['DOCUMENT_ROOT']);
require_once 'dashboard/include/db_connect.php';
require_once 'dashboard/services/reader_deckedbuilder.php';
require_once 'dashboard/services/reader_deckbattle.php';

if (isset($_FILES['deckimport'])) {
	// check $_FILES['ImageFile'] array is not empty
	// "is_uploaded_file" Tells whether the file was uploaded via HTTP POST
	if (!isset($_FILES['deckimport']) || !is_uploaded_file($_FILES['deckimport']['tmp_name'])) {
		$error = 'Something went wrong with Upload! Probably no file selected.';
		// output error when above checks fail.
	} else {

		$DeckName = strtolower($_FILES['deckimport']['name']);
		$TempSrc = $_FILES['deckimport']['tmp_name'];

		$Extension = substr($DeckName, strrpos($DeckName, '.'));
		$Extension = str_replace('.', '', $Extension);

		$uploaddir = $_SERVER['DOCUMENT_ROOT'] . '/dashboard/imports/decks/' . $_SESSION['user_id'] . "/";
		if (!is_dir($uploaddir)) {
			mkdir($uploaddir);
		}

		$uploadfile = $uploaddir . basename($_FILES['deckimport']['name']);

		if (move_uploaded_file($_FILES['deckimport']['tmp_name'], $uploadfile)) {
			switch(strtolower($Extension)) {
				case 'dec' :
					$info = importDeckedBuilder($_SESSION['user_id'], $uploadfile, $DeckName);
					break;
				case 'db1' :
					$info = importDeckBattle($_SESSION['user_id'], $uploadfile, $DeckName);
					break;
				case 'txt' :
					break;
				default :
					$error = 'Unsupported File!';
				//output error and exit
			}

			unlink($uploadfile);

		} else {
			$error = "Something went wrong, please try again or contact support.";
		}

	}
}
?>