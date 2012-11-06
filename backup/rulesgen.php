<?php

$data = file('rules.txt');

$sql = "INSERT INTO mtg_glossary values";

$temp = $sql = "INSERT INTO `w6022388_mtgdb`.`mtg_rules` (`ruleid`, `rule_chapter`, `rule_paragraph`, `rule`) VALUES (NULL, ";

$partone = "";
$parttwo = "";
$partthree = "";


foreach ($data as $val) {

if (trim($val) != '')
{
	//got a line with content
	//check first space, if pos is <=2 part one . is its <=5 part two  else rule
	//if part one found and it is different, clear part 2 and three
	//if part two is found clear three
		
	$pos = strpos($val,".");
	
	if ($pos <= 2)
	{
		if ($val != $partone)
		{
		$parttwo = $partthree = "";	
		}
	$partone = $val;
	}
	else if ($pos <= 4 &&  strpos($val," ") <=5)
	{
		if ($val != $parttwo)
		{
		$partthree = "";	
		}
	$parttwo = $val;
	}
	else 
	{
	$partthree = $val;
	}
	
	if ($partone != "" && $parttwo != "" && $partthree != "")
echo $sql . "\"" . trim(str_replace("\"","'", $partone)) . "\"," . "\"" . trim(str_replace("\"","'", $parttwo)) . "\",". "\"" . trim(str_replace("\"","'", $partthree)) . "\");";   	
	
	
/*	

	if ($pos === false)
	{
		//got a first value	
	$temp = $temp . "\"" . trim(str_replace("\"","'", $val)) . "\"|,";
	}
	else
	{
		$pos = strpos($temp,"#");
		if ($pos === false)
		{
		//got a second value	
		$temp = $temp . "\"" . trim(str_replace("\"","'", $val)) . "\"#,";
		}
		else		
		{
		$temp = $temp . "\"" . trim(str_replace("\"","'", $val)) . "\"~";
		}
	}
//}
// else {

	 $temp = str_replace("|","", $temp);
	 $temp = str_replace("#","", $temp);
	 echo $temp . ");<br />";
	 $temp = $sql;
 //}
}*/
}
}
?>