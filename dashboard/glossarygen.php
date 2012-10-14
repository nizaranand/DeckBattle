<?php

$mysqli = new mysqli("localhost", "w6022388_mtgdb", "OWVDPN1b", "w6022388_mtgdb");
/* check connection */
if (mysqli_connect_errno()) {
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit();
}


$data = file('glossary.txt');

$sql = "INSERT INTO mtg_glossary values";

$temp = $sql = "INSERT INTO `w6022388_mtgdb`.`mtg_glossary` (`itemid`, `itemname`, `itemdescription`) VALUES (NULL, ";

foreach ($data as $val) {
	//echo $val;
 if (trim($val) != '')
{
	$pos = strpos($temp,"|");
	if ($pos === false)
	{
		//got a first value	
	$temp = $temp . "\"" . trim(str_replace("\"","'", $val)) . "\"|,";
	}
	else
	{
		$temp = $temp . "\"" . trim(str_replace("\"","'", $val)) . "\"";
	
	}
}
 else {

	 echo str_replace("|","", $temp) . ");<br />";
	 $temp = $sql;
 }
}

$mysqli->close();


?>