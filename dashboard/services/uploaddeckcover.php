<?php
set_include_path($_SERVER['DOCUMENT_ROOT']);
include 'dashboard/include/db_connect.php';
include 'dashboard/include/resize_images.php';

if(isset($_FILES['imagefile']))
{
    // check $_FILES['ImageFile'] array is not empty
    // "is_uploaded_file" Tells whether the file was uploaded via HTTP POST
    if(!isset($_FILES['imagefile']) || !is_uploaded_file($_FILES['imagefile']['tmp_name']))
    {
            $error = 'Something went wrong with Upload! Probably no file selected.'; // output error when above checks fail.
    }
	else
	{
 
    $DeckName      =  strtolower($_FILES['imagefile']['name']);
    $TempSrc        = $_FILES['imagefile']['tmp_name']; 
  
    $Extension = substr($DeckName, strrpos($DeckName, '.'));
    $Extension = str_replace('.','',$Extension);
 
 
 $uploaddir = $_SERVER['DOCUMENT_ROOT'] . '/dashboard/images/decks/usercovers/' . $_SESSION['user_id'] . "/";
	 if (!is_dir($uploaddir)) {
    		mkdir($uploaddir);
	}
	
	$uploadfile = $uploaddir . basename($_FILES['imagefile']['name']);


	 // array of valid extensions
    $validExtensions = array('.jpg', '.jpeg', '.gif', '.png');
    // get extension of the uploaded file
    $fileExtension = strrchr($_FILES['imagefile']['name'], ".");
    // check if file Extension is on the list of allowed ones
    if (in_array($fileExtension, $validExtensions)) {
     //   echo 'Uploaded file is allowed!';
    
	
	 $newNamePrefix = time() . '_';
        $manipulator = new ImageManipulator($_FILES['imagefile']['tmp_name']);
        $width  = $manipulator->getWidth();
        $height = $manipulator->getHeight();
        $centreX = round($width / 2);
        $centreY = round($height / 2);
        // our dimensions will be 128x178
        $x1 = $centreX - 64; // 128 / 2
        $y1 = $centreY - 89; // 178 / 2
 
        $x2 = $centreX + 64; // 128 / 2 = 64
        $y2 = $centreY + 89; // 178 / 2 = 89
 
        // center cropping
        $newImage = $manipulator->crop($x1, $y1, $x2, $y2);
        // saving file to uploads folder
        $manipulator->save($uploaddir . $newNamePrefix . $_FILES['imagefile']['name']);
        //echo 'Done ...';
			    
			//add to database
			$imagenamefordb = $newNamePrefix . $_FILES['imagefile']['name'];
			
			if ($update = $mysqli->prepare("UPDATE user_decks SET deckimage = ? WHERE userid = ? AND id = ?")) {    
				$update->bind_param('sss',$imagenamefordb, $_SESSION['user_id'] ,$deckid); 
				$update->execute();
			}
	} 
	else {
		// not valid extension
        $error = 'You must upload an image like a .jpg/jpeg .png or .gif';
    }
	}
}
 ?>