<?php
set_include_path($_SERVER['DOCUMENT_ROOT']);
require_once 'dashboard/include/db_connect.php';

$deckid = $_GET['deckid'];
$dataset0 = 0;
$dataset1 = 0;
$dataset2 = 0;
$dataset3 = 0;
$dataset4 = 0;
$dataset5 = 0;
$dataset6 = 0;
$dataset7plus = 0;

$omething = $mysqli -> query('SET CHARACTER SET utf8');
$q = "SELECT Nconverted_manacost,(amount_normal+amount_foil) as total FROM user_decks_cards JOIN Ncards on Ncardid = cardid WHERE Ntype NOT LIKE '%Land%' AND deckid = ? AND location = 'Deck'";
if ($stmt = $mysqli -> prepare($q)) {
    $stmt -> bind_param('s', $deckid);
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

$dataset = array();

$ar = array();

$ar[] = array( 0,$dataset0);
$ar[] = array( 1,$dataset1);
$ar[] = array( 2,$dataset2);
$ar[] = array( 3,$dataset3);
$ar[] = array( 4,$dataset4);
$ar[] = array( 5,$dataset5);
$ar[] = array( 6,$dataset6);
$ar[] = array( 7,$dataset7plus);

 
     $ds = array();
     
     $ds[] = array(data=>$ar,bars=>array(show=>true,barWidth=>0.6,order=>1));
 

echo json_encode($ds);
?>