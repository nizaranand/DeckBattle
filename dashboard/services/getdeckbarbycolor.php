<?php
set_include_path($_SERVER['DOCUMENT_ROOT']);
require_once 'dashboard/include/db_connect.php';

$deckid = $_GET['deckid'];

function t ($deckid,$color,$mysqli){
  
  $charlenghtMin = 1;
  $charlenghtMax = 1;
  
  if ($color == "%") {
      $charlenghtMin = 2;
  $charlenghtMax = 100;
  }
  
  $dataset0 = 0;
$dataset1 = 0;
$dataset2 = 0;
$dataset3 = 0;
$dataset4 = 0;
$dataset5 = 0;
$dataset6 = 0;
$dataset7plus = 0;

$omething = $mysqli -> query('SET CHARACTER SET utf8');
$q = "SELECT Nconverted_manacost,(amount_normal+amount_foil) as total FROM user_decks_cards JOIN Ncards on Ncardid = cardid WHERE Ncolor like ? AND CHAR_LENGTH(Ncolor) >= ? AND CHAR_LENGTH(Ncolor) <= ? AND Ntype NOT LIKE '%Land%' AND deckid = ? AND location = 'Deck'";
if ($stmt = $mysqli -> prepare($q)) {
    $stmt -> bind_param('ssss', $color,$charlenghtMin,$charlenghtMax, $deckid);
    $stmt -> execute();
    $stmt -> store_result();
    $stmt -> bind_result($cost, $amount);

    while ($stmt -> fetch()) {
            if ($cost == 0) {
                $dataset0 += $amount;
            }
            if ($cost == 1) {
                $dataset1 += $amount;
            }
            if ($cost == 2) {
                $dataset2 += $amount;
            }
            if ($cost == 3) {
                $dataset3 += $amount;
            }
            if ($cost == 4) {
                $dataset4 += $amount;
            }
            if ($cost == 5) {
                $dataset5 += $amount;
            }
            if ($cost == 6) {
                $dataset6 += $amount;
            }
            if ($cost >= 7) {
                $dataset7plus += $amount;
            }
    }
}


$ar = array();

$ar[] = array( 0,$dataset0);
$ar[] = array( 1,$dataset1);
$ar[] = array( 2,$dataset2);
$ar[] = array( 3,$dataset3);
$ar[] = array( 4,$dataset4);
$ar[] = array( 5,$dataset5);
$ar[] = array( 6,$dataset6);
$ar[] = array( 7,$dataset7plus);
  
    return $ar;
    
}

     $ds = array();
     
     $ds[] = array(data=>t($deckid,"A",$mysqli),bars=>array(show=>true,barWidth=>0.1,order=>1),color=>'#aaaaaa');
     $ds[] = array(data=>t($deckid,"R",$mysqli),bars=>array(show=>true,barWidth=>0.1,order=>1),color=>'red');
     $ds[] = array(data=>t($deckid,"B",$mysqli),bars=>array(show=>true,barWidth=>0.1,order=>1),color=>'black');
     $ds[] = array(data=>t($deckid,"U",$mysqli),bars=>array(show=>true,barWidth=>0.1,order=>1),color=>'blue');
     $ds[] = array(data=>t($deckid,"G",$mysqli),bars=>array(show=>true,barWidth=>0.1,order=>1),color=>'green');
     $ds[] = array(data=>t($deckid,"W",$mysqli),bars=>array(show=>true,barWidth=>0.1,order=>1),color=>'white');
     $ds[] = array(data=>t($deckid,"%",$mysqli),bars=>array(show=>true,barWidth=>0.1,order=>1),color=>'orange');
    
echo json_encode($ds);


?>