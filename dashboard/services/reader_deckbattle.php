<?php

function importDeckBattle($userid, $deckfile, $deckname_input) {

	$mysqli = new mysqli("localhost", "w6022388_mtgdb", "OWVDPN1b", "w6022388_mtgdb");

	if (mysqli_connect_errno()) {
		printf("Connect failed: %s\n", mysqli_connect_error());
		exit();
	}

	$deckname = str_replace(".db1", "", $deckname_input);
	$deckid = "";

	//DECK
	if ($stmt = $mysqli -> prepare("SELECT id FROM user_decks WHERE userid = ? AND deckname = ?")) {
		$stmt -> bind_param('ss', $userid, $deckname);
		$stmt -> execute();
		$stmt -> store_result();
		$stmt -> bind_result($rowid);
		// get variables from result.
		$stmt -> fetch();

		$deckid = $rowid;

		if ($stmt -> num_rows == 0) {// If the user + deck not exists
			if ($insert = $mysqli -> prepare("INSERT INTO user_decks (userid, deckname,extension,updated) VALUES (?,?,'.db1',now())")) {
				$insert -> bind_param('ss', $userid, $deckname);
				$insert -> execute();

				$deckid = $insert -> insert_id;
				$info = "DeckedBuilder file uploaded and processed. New Deck created.";
			}
		} else {//deck exists  ...delete all related cards. Overwrite standard (later .. make versions

			$stmt = $mysqli -> prepare("DELETE FROM user_decks_cards WHERE deckid = ?");
			$stmt -> bind_param('s', $deckid);
			$stmt -> execute();
			$info = "DeckedBuilder file uploaded and processed. Existing deck overridden.";

			if ($update = $mysqli -> prepare("UPDATE user_decks SET updated = now() WHERE userid = ? AND id = ?")) {
				$update -> bind_param('ss', $userid, $deckid);
				$update -> execute();
			}
		}
	}

	$data = file($deckfile);

	foreach ($data as $val) {
		if (trim($val) != '') {
			$multiverseID = "";

			$pos = strpos($val, "///");
			if ($pos === false) {
				$pos = strpos($val, "//");

				//check first line for deck data
				if ($pos === false) {
					// nothing

				} else {

					list($text, $deckimage, $fav, $color) = explode(";", $val . ";");

					$deckimage = trim(str_replace(" isFavorite", "", $deckimage));
					$fav = trim(str_replace(" color", "", $fav));
					$color = trim($color);

					if ($update = $mysqli -> prepare("UPDATE user_decks SET color = ?, deckimage = ?,isFavorite = ? WHERE userid = ? AND id = ?")) {
						$update -> bind_param('sssss', $color, $deckimage, $fav, $userid, $deckid);
						$update -> execute();

					}
				}
			} else {
				//got a valid line,
				list($textmvid, $id, $qty, $textname, $loc, $foil) = explode(":", $val . ":");
				// ///mvid  :   249813 qty  :   25 name :   Plains loc:Deck foil:12

				$cardid = trim(str_replace(" qty", "", $id));
				$amount = trim(str_replace(" name", "", $qty));
				$location = trim(str_replace(" foil", "", $loc));
				$amountF = trim($foil);

				if ($stmt = $mysqli -> prepare("SELECT id FROM user_decks_cards WHERE cardid = ? AND deckid = ?")) {
					$stmt -> bind_param('ss', $cardid, $deckid);
					$stmt -> execute();
					$stmt -> store_result();
					$stmt -> bind_result($cardsrowid);
					// get variables from result.
					$stmt -> fetch();

					$tempid = $cardsrowid;

					if ($stmt -> num_rows == 0) {// If the user + card exists
						if ($insert = $mysqli -> prepare("INSERT INTO user_decks_cards (cardid, deckid, amount_normal, amount_foil, location) VALUES (?,?,?,?,?)")) {
							$insert -> bind_param('sssss', $cardid, $deckid, $amount, $amountF, $location);
							$insert -> execute();

						}
					} else {
						if ($insert = $mysqli -> prepare("UPDATE user_decks_cards SET amount_normal = ?, amount_foil = ? , location = ? WHERE id = ? ")) {
							$insert -> bind_param('ssss', $amount, $amountF, $location, $tempid);
							$insert -> execute();

						}
					}
				}
			}
		}
	}

	$mysqli -> close();

	return $info;
}
?>