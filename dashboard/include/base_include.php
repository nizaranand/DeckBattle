<?php

include 'dashboard/include/db_connect.php';
include 'dashboard/include/login_functions.php';

sec_session_start();

if (login_check($mysqli) != true) {

	header('Location: http://www.deckbattle.com/dashboard/login.php?error=notloggedin');

}

//DECK FUNCTIONS AND VARS
$dir_usercovers = $_SERVER['DOCUMENT_ROOT'] . "/dashboard/images/decks/usercovers/" . $_SESSION['user_id'] . "/";
$noColorDeckImage = "/dashboard/images/decks/standardcovers/deckcover_nocards.png";

function determineImageAndClass($db_color) {

	if ($db_color == "") {
		$imgurl = "/dashboard/images/decks/standardcovers/deckcover_nocards.png";
		$class = "none";
	}

	if ($db_color == "{R}") {
		$imgurl = "/dashboard/images/decks/standardcovers/deckcover_mountain.png";
		$class = "red";
	}

	if ($db_color == "{G}") {
		$imgurl = "/dashboard/images/decks/standardcovers/deckcover_forest.png";
		$class = "green";
	}

	if ($db_color == "{B}") {
		$imgurl = "/dashboard/images/decks/standardcovers/deckcover_swamp.png";
		$class = "black";
	}

	if ($db_color == "{U}") {
		$imgurl = "/dashboard/images/decks/standardcovers/deckcover_island.png";
		$class = "blue";
	}

	if ($db_color == "{W}") {
		$imgurl = "/dashboard/images/decks/standardcovers/deckcover_plains.png";
		$class = "white";
	}

	if ($db_color == "{A}") {
		$imgurl = "/dashboard/images/decks/standardcovers/deckcover_artifact.png";
		$class = "artifact";
	}

	$temp = explode("}", $db_color);
	$size = count($temp);

	if ($size == 3) {
		$imgurl = "/dashboard/images/decks/standardcovers/deckcover_multicolor.png";
		$class = "twocolors";
	}

	if ($size == 4) {
		$imgurl = "/dashboard/images/decks/standardcovers/deckcover_multicolor.png";
		$class = "threecolors";
	}

	if ($size == 5) {
		$imgurl = "/dashboard/images/decks/standardcovers/deckcover_multicolor.png";
		$class = "fourcolors";
	}

	if ($size == 6) {
		$imgurl = "/dashboard/images/decks/standardcovers/deckcover_multicolor.png";
		$class = "fivecolors";
	}

	return array("url" => $imgurl, "class" => $class);
}

//END DECK FUNCTIONS AND VARS
?>