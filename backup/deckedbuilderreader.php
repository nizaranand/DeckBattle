<?php

$mysqli = new mysqli("localhost", "w6022388_mtgdb", "OWVDPN1b", "w6022388_mtgdb");
/* check connection */
if (mysqli_connect_errno()) {
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit();
}

$userid = 33;

$deckfile = 'Missend Dark Ascension.dec';
$deckname = str_replace(".dec","",$deckfile);
$deckid = "";

//DECK
if ($stmt = $mysqli->prepare("SELECT id FROM user_decks WHERE userid = ? AND deckname = ?")) { 
	$stmt->bind_param('ss', $userid,$deckname); 
	$stmt->execute(); 
	$stmt->store_result();
	$stmt->bind_result($rowid); // get variables from result.
	$stmt->fetch();
	
	$deckid  = $rowid;
				
	if($stmt->num_rows == 0) { // If the user + card exists
		if ($insert = $mysqli->prepare("INSERT INTO user_decks (userid, deckname) VALUES (?,?)")) {    
			$insert->bind_param('ss',$userid ,$deckname); 
			$insert->execute();
			
			$deckid = $insert->insert_id;
			
		}
	}
}



$data = file($deckfile);


foreach ($data as $val) {
	if (trim($val) != '')
	{
		$multiverseID = "";
		
		$pos = strpos($val, "///");
		if ($pos === false)
		{
			//
		}
		else {
			//got a valid line, 
			list($textmvid, $id, $qty, $textname, $loc) = explode(":", $val . ":");
			
			$cardid = trim(str_replace(" qty","",$id));
			$amount =  trim(str_replace(" name","", $qty));
			$amountF = "";
			$location= trim($loc);
		
			if ($stmt = $mysqli->prepare("SELECT id FROM user_decks_cards WHERE cardid = ? AND deckid = ?")) { 
				$stmt->bind_param('ss', $cardid, $deckid); 
				$stmt->execute(); 
				$stmt->store_result();
				$stmt->bind_result($cardsrowid); // get variables from result.
				$stmt->fetch();
				
				$tempid = $cardsrowid;
	
				if($stmt->num_rows == 0) { // If the user + card exists
					if ($insert = $mysqli->prepare("INSERT INTO user_decks_cards (cardid, deckid, amount_normal, amount_foil, location) VALUES (?,?,?,?,?)")) {    
						$insert->bind_param('sssss',$cardid ,$deckid, $amount, $amountF, $location); 
						$insert->execute();
									
					}
				}
				else {
					if ($insert = $mysqli->prepare("UPDATE user_decks_cards SET amount_normal = ?, amount_foil = ? , location = ? WHERE id = ? ")) {    
						$insert->bind_param('ssss',$amount, $amountF, $location, $tempid); 
						$insert->execute();
			
					}	
				}
			}
		}
	}
}

$mysqli->close();


?>