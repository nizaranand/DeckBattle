<?php
set_include_path($_SERVER['DOCUMENT_ROOT']);
include 'dashboard/include/db_connect.php';
include 'dashboard/services/reader_deckedbuilder.php';

if(isset($_FILES['deckimport']))
{
    // check $_FILES['ImageFile'] array is not empty
    // "is_uploaded_file" Tells whether the file was uploaded via HTTP POST
    if(!isset($_FILES['deckimport']) || !is_uploaded_file($_FILES['deckimport']['tmp_name']))
    {
            $error = 'Something went wrong with Upload! Probably no file selected.'; // output error when above checks fail.
    }
	else
	{
 
    // Elements (values) of $_FILES['ImageFile'] array
    //let's access these values by using their index position
    $DeckName      =  strtolower($_FILES['deckimport']['name']);
    $TempSrc        = $_FILES['deckimport']['tmp_name']; // Tmp name of image file stored in PHP tmp folder
    $FileType      = $_FILES['deckimport']['type']; //Obtain file type, returns "image/png", image/jpeg, text/plain etc.
 
    $Extension = substr($DeckName, strrpos($DeckName, '.'));
    $Extension = str_replace('.','',$Extension);
 
    //Let's use $ImageType variable to check wheather uploaded file is supported.
    //We use PHP SWITCH statement to check valid image format, PHP SWITCH is similar to IF/ELSE statements
    //suitable if we want to compare the a variable with many different values
 
 $uploaddir = $_SERVER['DOCUMENT_ROOT'] . '/decks/' . $_SESSION['user_id'] . "/";
 if (!is_dir($uploaddir)) {
    mkdir($uploaddir);
}
$uploadfile = $uploaddir . basename($_FILES['deckimport']['name']);

if (move_uploaded_file($_FILES['deckimport']['tmp_name'], $uploadfile)) {
   switch(strtolower($Extension))
    {
        case 'dec':
	      	$info = importDeckedBuilder($_SESSION['user_id'],$uploadfile,$DeckName);
     	    
	        break;
        case 'txt':
            break;
        case 'csv':
            break;
        default:
            $error = 'Unsupported File!'; //output error and exit
    }

} else {
    $error= "Something went wrong, please try again or contact support.";
}

 
	}
}
 ?>