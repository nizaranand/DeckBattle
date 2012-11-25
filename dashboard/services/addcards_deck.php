<?php
set_include_path($_SERVER['DOCUMENT_ROOT']);
require_once 'dashboard/include/db_connect.php';

$cardid = $_POST['cardid'];
$userid = $_POST['userid'];
$deckid = $_POST['deckid'];
$amountN = $_POST['amountn'];
$amountF = $_POST['amountf'];
$fav = $_POST['addtofav'];
$cardname = $_POST['cardname'];
$location = $_POST['loc'];

//add to favs //TODO make function used in collection also
if ($fav > 0) {

    if ($stmt = $mysqli -> prepare("SELECT id FROM user_favoritecards WHERE userid = ? AND cardid = ?")) {
        $stmt -> bind_param('ss', $userid, $cardid);
        $stmt -> execute();
        $stmt -> store_result();

        if ($stmt -> num_rows == 0) {

            if ($insert = $mysqli -> prepare("INSERT INTO user_favoritecards (userid, cardid) VALUES (?,?);")) {
                $insert -> bind_param('ss', $userid, $cardid);
                $insert -> execute();
                echo "addedfav";
            }

        } else {
            if ($delete = $mysqli -> prepare("DELETE FROM user_favoritecards WHERE userid = ? AND cardid = ?")) {
                $delete -> bind_param('ss', $userid, $cardid);
                $delete -> execute();
                echo "removedfav";
            }
        }
    }
}


//add to collection
if ($amountN != 0 || $amountF != 0) {

    $outputamountN = $amountN;
    $outputamountF = $amountF;

if ($outputamountF < 0){
                    $message = "(Foil) Card ". $cardname ." removed from collection";
}
else if ($outputamountF > 0){
                    $message = "(Foil) Card ". $cardname ." added to collection";
}

if ($outputamountN < 0){
                    $message = "Card ". $cardname ." removed from collection";
}
else if ($outputamountN > 0){
                    $message = "Card ". $cardname ." added to collection";
}

    if ($stmt = $mysqli -> prepare("SELECT id, amount_normal, amount_foil FROM user_decks_cards WHERE  cardid = ? AND deckid = ? AND location = ?")) {
        $stmt -> bind_param('sss', $cardid,$deckid,$location);
        $stmt -> execute();
        $stmt -> store_result();
        $stmt -> bind_result($rowid, $dbamountN, $dbamountF);
        // get variables from result.
        $stmt -> fetch();

        if ($stmt -> num_rows > 0) {// If the user + card exists

            $tn = $dbamountN + $amountN;
            $tf = $dbamountF + $amountF;

            if ($tn < 0)
                $tn = 0;

            if ($tf < 0)
                $tf = 0;

            $id = $rowid;
            if ($update_stmt = $mysqli -> prepare("UPDATE user_decks_cards SET amount_normal = ?, amount_foil = ? WHERE id = ?;")) {
                $update_stmt -> bind_param('sss', $tn, $tf, $id);
                $update_stmt -> execute();

                $outputamountN = $tn;
                $outputamountF = $tf;

            }
        } else {
            if ($amountN > 0 || $amountF > 0) {
                if ($insert = $mysqli -> prepare("INSERT INTO user_decks_cards (cardid, deckid,amount_normal, amount_foil,location) VALUES (?,?,?,?,?);")) {
                    $insert -> bind_param('sssss', $cardid,$deckid, $amountN, $amountF,$location);
                    $insert -> execute();
                }
            }
        }
    }

    //cleanup
    if ($stmt = $mysqli -> prepare("SELECT id, amount_normal, amount_foil FROM user_decks_cards WHERE cardid = ? AND deckid=? AND location = ?")) {
        $stmt -> bind_param('sss', $cardid,$deckid,$location);
        $stmt -> execute();
        $stmt -> store_result();
        $stmt -> bind_result($rowid, $dbamountN, $dbamountF);
        // get variables from result.
        $stmt -> fetch();

        if ($stmt -> num_rows > 0) {// If the user + card exists
            if ($dbamountN == 0 && $dbamountF == 0) {
                $r = $rowid;
                if ($insert = $mysqli -> prepare("DELETE FROM user_decks_cards WHERE id = ?;")) {
                    $insert -> bind_param('s', $r);
                    $insert -> execute();
                }
            }
        }
    }
    
    //return amount
    if ($outputamountF < 0) $outputamountF = 0;
    if ($outputamountN < 0) $outputamountN =0;
    
    echo $message . "/". $outputamountN . "/" . $outputamountF;
}
?>