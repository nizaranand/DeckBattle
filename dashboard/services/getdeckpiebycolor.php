<?php
set_include_path($_SERVER['DOCUMENT_ROOT']);
require_once 'dashboard/include/db_connect.php';

$deckid = $_GET['deckid'];
//echo $deckid;
$datasetRed = 0;
$datasetGreen = 0;
$datasetBlue = 0;
$datasetBlack = 0;
$datasetWhite = 0;
$datasetArtifact = 0;
$datasetMulti = 0;

$omething = $mysqli -> query('SET CHARACTER SET utf8');
$q = "SELECT Ncolor,(amount_normal+amount_foil) as total FROM user_decks_cards JOIN Ncards on Ncardid = cardid WHERE deckid = ? AND location = 'Deck'";
if ($stmt = $mysqli -> prepare($q)) {
    $stmt -> bind_param('s', $deckid);
    $stmt -> execute();
    $stmt -> store_result();
    $stmt -> bind_result($color, $amount);

    while ($stmt -> fetch()) {

        if (strlen($color) > 1) {
            $datasetMulti += $amount;
        } else {

            if (strpos($color, "R") !== false) {
                $datasetRed += $amount;
            }

            if (strpos($color, "G") !== false) {
                $datasetGreen += $amount;
            }

            if (strpos($color, "W") !== false) {
                $datasetWhite += $amount;
            }

            if (strpos($color, "B") !== false) {
                $datasetBlack += $amount;
            }

            if (strpos($color, "U") !== false) {
                $datasetBlue += $amount;
            }

            if (strpos($color, "A") !== false) {
                $datasetArtifact += $amount;
            }
        }
    }
}

$dataset1 = array();

if ($datasetRed > 0)
    $dataset1[] = array(label => "Red", data => $datasetRed);

if ($datasetGreen > 0)
    $dataset1[] = array(label => "Green", data => $datasetGree);

if ($datasetWhite > 0)
    $dataset1[] = array(label => "White", data => $datasetWhite);

if ($datasetBlack > 0)
    $dataset1[] = array(label => "Black", data => $datasetBlack);

if ($datasetBlue > 0)
    $dataset1[] = array(label => "Blue", data => $datasetBlue);

if ($datasetArtifact > 0)
    $dataset1[] = array(label => "Artifact", data => $datasetArtifact);

    if ($datasetMulti > 0)
    $dataset1[] = array(label => "Multicolor", data => $datasetMulti);

echo json_encode($dataset1);
?>