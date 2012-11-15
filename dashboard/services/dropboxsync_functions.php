<?php
// HELPERS
function checkExtension($file,$extensionToCheck)
{
	$temparray = explode(".",$file);
	$extension = end($temparray);
	
	if ($extension == $extensionToCheck){
		return true;
	}
	
	return false;
}

function checkIfDeckExistsInDatabase($deckpath,$db,$mysqli)
{
	$outFile = false;
	$fileForname = $db->getFile($deckpath, $outFile);
	$deckname = urldecode($fileForname["name"]);

	if (checkExtension($deckname,"dec"))
	{
		$deckname = str_replace(".dec","",$deckname);
	}
	if (checkExtension($deckname,"db1"))
	{
		$deckname = str_replace(".db1","",$deckname);
	}
	
	if ($stmt = $mysqli->prepare("SELECT deckname FROM user_decks WHERE deckname = ?")) { 
		$stmt->bind_param('s', $deckname); 
		$stmt->execute(); 
		$stmt->store_result();
		
		if($stmt->num_rows == 0) {
			return "uNew";
		}
		else
		{
			return "uSync";
		}
	}
}

function checkIfDeckInDropbox($content,$deckname_input,$db){
	$result = false;
	
	$max = sizeof($content);
	if ($max > 0) {
		for ($i=0; $i<$max; $i++) {
			if ($content[$i]->is_dir == "1") {
				$metaDataDeep = $db->metaData($content[$i]->path);
				checkIfDeckInDropbox($metaDataDeep["body"]->contents,$deckname_input,$db);
			}
			else {
	
				$modified = $content[$i]->modified;
				$date = strtotime($modified);
				
				$outFile = false;
				$fileForname = $db->getFile($content[$i]->path, $outFile);
				$Deckname = urldecode($fileForname["name"]);

				if (checkExtension($Deckname,"dec"))
				{
					$Deckname = str_replace(".dec","",$Deckname);
				}
				if (checkExtension($Deckname,"db1"))
				{
					$Deckname = str_replace(".db1","",$Deckname);
				}
				
				if ($Deckname == $deckname_input)
				$result = true;
			}
		}
	}
	
	return($result);
}


function addFilesToDropbox($db,$mysqli){
	if ($stmt = $mysqli->prepare("SELECT id, deckname, updated,dropboxPath,extension,deckimage,isFavorite,color FROM user_decks WHERE userid = ? AND markfordropbox = 1")) { 
	$stmt->bind_param('s', $_SESSION['user_id']); 
	$stmt->execute(); 
	$stmt->store_result();
	$stmt->bind_result($deckid,$db_deckname, $updated, $dropboxPath,$extension,$deckimage,$fav,$color); // get variables from result.
		
		 while ($stmt->fetch()) {
			$path = "/";
			$metaData = $db->metaData($path);
			$content = $metaData["body"]->contents;
		
			 if (!checkIfDeckInDropbox($content,$db_deckname,$db))
			 {
				//create file
				$ourFileName = $db_deckname . $extension;
				$ourFileHandle = fopen($ourFileName, 'w') or die("can't open file");
				//put in data

				//first line	

				$stringData = "//Deckbattle Deck Data//deckimage;" . $deckimage . " isFavorite;" . $fav . " color;" . $color .  "\n";
				fwrite($ourFileHandle, $stringData);

				
if ($stmt1 = $mysqli->prepare("SELECT cardid, amount_normal, amount_foil, location,Ncardname FROM user_decks_cards join Ncards on cardid=Ncardid WHERE deckid = ? ")) { 
	$stmt1->bind_param('s', $deckid); 
	$stmt1->execute(); 
	$stmt1->store_result();
	$stmt1->bind_result($cardid,$an, $af, $location,$cardname); // get variables from result.
		
		 while ($stmt1->fetch()) {
			 
			 if ($extension == ".db1")
			 {
				$stringData = "///mvid:" . $cardid . " qty:" . $an . " name:" . $cardname. " loc:" . $location. " foil:" . $af.  "\n";
			 }
			 if ($extension == ".dec")
			 {
				 // .dec has no foil support so adding foil + normal just to be sure if the deck was not converted.;
				 $qty = ($an+$af);
				$stringData = "///mvid:" . $cardid . " qty:" . $qty . " name:" . $cardname. " loc:" . $location. "\n" . $qty . " " . $cardname . "\n";
				// ///mvid:249813 qty:25 name:Plains loc:Deck
				// 25 Plains
			 }
			 if ($extension == ".txt")
			 { // simple ; separated including foil but can be discarded
				$stringData =  $an . ";" . $af . ";" . $cardid . ";" . $cardname . "\n";
			 }
			 
			 
				fwrite($ourFileHandle, $stringData);
		 }
}
				fclose($ourFileHandle);
				
				//put file
				$put = $db->putFile($ourFileName);
				//add file path to database
				//update dropbox path
		
				//delete original file
				unlink($ourFileName);
		
			 }
		  }
	}
}



function syncFiles($content,$db){
	$max = sizeof($content);
	if ($max > 0) {
		for ($i=0; $i<$max; $i++) {
			if ($content[$i]->is_dir == "1") {
				$metaDataDeep = $db->metaData($content[$i]->path);
				syncFiles($metaDataDeep["body"]->contents,$db);
			}
			else {
	
				$modified = $content[$i]->modified;
				$date = strtotime($modified);
			
				$outFile = false;
				$fileForname = $db->getFile($content[$i]->path, $outFile);
				$Deckname = urldecode($fileForname["name"]);
								
				
				$outFile = $_SESSION['user_id'] . "_" . $Deckname;
				$file = $db->getFile($content[$i]->path, $outFile);
				
				if (checkExtension($file["name"],"dec")) {
					$info = importDeckedBuilder($_SESSION['user_id'],"" . $file["name"],$Deckname);
				}
				if (checkExtension($file["name"],"db1")) {
					$info = importDeckBattle($_SESSION['user_id'],"" . $file["name"],$Deckname);
				}
				unlink($file["name"]);
			}
		}
	}
}


?>