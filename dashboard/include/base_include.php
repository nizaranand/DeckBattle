<?php

require_once 'dashboard/include/db_connect.php';
require_once 'dashboard/include/login_functions.php';

sec_session_start();

if (login_check($mysqli) != true) {

	header('Location: http://www.deckbattle.com/dashboard/login.php?error=notloggedin');

}


//DECK FUNCTIONS AND VARS
$dir_usercovers = $_SERVER['DOCUMENT_ROOT'] . "/dashboard/images/decks/usercovers/" . $_SESSION['user_id'] . "/";
$dir_imagedeckcover = "/dashboard/images/decks/usercovers/" . $_SESSION['user_id'] . "/";
$noColorDeckImage = "/dashboard/images/decks/standardcovers/deckcover_nocards.png";

function showDeckColors($color){
   
  $result = str_replace("{R}",'<img style="display:inline;" src="http://www.deckbattle.com/mtgicons/R.gif" />',$color);
  $result = str_replace("{W}",'<img style="display:inline;" src="http://www.deckbattle.com/mtgicons/W.gif" />',$result);
  $result = str_replace("{G}",'<img style="display:inline;" src="http://www.deckbattle.com/mtgicons/G.gif" />',$result);
  $result = str_replace("{U}",'<img style="display:inline;" src="http://www.deckbattle.com/mtgicons/U.gif" />',$result);
  $result = str_replace("{B}",'<img style="display:inline;" src="http://www.deckbattle.com/mtgicons/B.gif" />',$result);
  $result = str_replace("{A}",'<img style="display:inline;" src="http://www.deckbattle.com/mtgicons/A.gif" />',$result);
   
  return $result;
    
}

function calcAverageManaCost($deckid) {
    $result = 0;
    
    
    return $result;
}

function calcColoredMana($number) {
    
    $result = 0;
    
    
    return $result;
    
}

function calcTotalMissing($deckid){
    
  return "-";  
    
}

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