<?php
set_include_path($_SERVER['DOCUMENT_ROOT']);
require_once 'dashboard/include/db_connect.php';

$cardid = $_POST['cardid'];
$userid = $_POST['userid'];
$amountN = $_POST['amountn'];
$amountF = $_POST['amountf'];
$wishamountN = $_POST['wishamountn'];
$wishamountF = $_POST['wishamountf'];
$fav = $_POST['addtofav'];
$cardname = $_POST['cardname'];

//add to favs
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

//add to wishlist
if ($wishamountN != 0 || $wishamountF != 0) {

    if ($stmt = $mysqli -> prepare("SELECT id, amount_normal, amount_foil FROM user_wishlist WHERE userid = ? AND cardid = ?")) {
        $stmt -> bind_param('ss', $userid, $cardid);
        $stmt -> execute();
        $stmt -> store_result();
        $stmt -> bind_result($rowid, $dbamountN, $dbamountF);
        // get variables from result.
        $stmt -> fetch();

        if ($stmt -> num_rows > 0) {// If the user + card exists
            $tn = $dbamountN + $wishamountN;
            $tf = $dbamountF + $wishamountF;

            if ($tn < 0)
                $tn = 0;

            if ($tf < 0)
                $tf = 0;

            $id = $rowid;
            if ($update_stmt = $mysqli -> prepare("UPDATE user_wishlist SET amount_normal = ?, amount_foil = ? WHERE id = ?;")) {
                $update_stmt -> bind_param('sss', $tn, $tf, $id);
                $update_stmt -> execute();

            }
        } else {
            if ($wishamountN > 0 || $wishamountF > 0) {
                if ($insert = $mysqli -> prepare("INSERT INTO user_wishlist (userid, cardid, amount_normal, amount_foil) VALUES (?,?,?,?);")) {
                    $insert -> bind_param('ssss', $userid, $cardid, $wishamountN, $wishamountF);
                    $insert -> execute();
                }
            }
        }
    }

    //cleanup
    if ($stmt = $mysqli -> prepare("SELECT id, amount_normal, amount_foil FROM user_wishlist WHERE userid = ? AND cardid = ?")) {
        $stmt -> bind_param('ss', $userid, $cardid);
        $stmt -> execute();
        $stmt -> store_result();
        $stmt -> bind_result($rowid, $dbamountN, $dbamountF);
        // get variables from result.
        $stmt -> fetch();

        if ($stmt -> num_rows > 0) {// If the user + card exists
            if ($dbamountN == 0 && $dbamountF == 0) {
                $r = $rowid;
                if ($insert = $mysqli -> prepare("DELETE FROM user_wishlist WHERE id = ?;")) {
                    $insert -> bind_param('s', $r);
                    $insert -> execute();
                }
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

    if ($stmt = $mysqli -> prepare("SELECT id, amount_normal, amount_foil FROM user_cardcollection WHERE userid = ? AND cardid = ?")) {
        $stmt -> bind_param('ss', $userid, $cardid);
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
            if ($update_stmt = $mysqli -> prepare("UPDATE user_cardcollection SET amount_normal = ?, amount_foil = ? WHERE id = ?;")) {
                $update_stmt -> bind_param('sss', $tn, $tf, $id);
                $update_stmt -> execute();

                $outputamountN = $tn;
                $outputamountF = $tf;

            }
        } else {
            if ($amountN > 0 || $amountF > 0) {
                if ($insert = $mysqli -> prepare("INSERT INTO user_cardcollection (userid, cardid, amount_normal, amount_foil) VALUES (?,?,?,?);")) {
                    $insert -> bind_param('ssss', $userid, $cardid, $amountN, $amountF);
                    $insert -> execute();
                }
            }
        }
    }

    //cleanup
    if ($stmt = $mysqli -> prepare("SELECT id, amount_normal, amount_foil FROM user_cardcollection WHERE userid = ? AND cardid = ?")) {
        $stmt -> bind_param('ss', $userid, $cardid);
        $stmt -> execute();
        $stmt -> store_result();
        $stmt -> bind_result($rowid, $dbamountN, $dbamountF);
        // get variables from result.
        $stmt -> fetch();

        if ($stmt -> num_rows > 0) {// If the user + card exists
            if ($dbamountN == 0 && $dbamountF == 0) {
                $r = $rowid;
                if ($insert = $mysqli -> prepare("DELETE FROM user_cardcollection WHERE id = ?;")) {
                    $insert -> bind_param('s', $r);
                    $insert -> execute();
                }
            }
        }
    }

    if ($stmt = $mysqli -> prepare("SELECT SUM(amount_normal), SUM(amount_foil) FROM user_cardcollection WHERE userid = ?")) {
        $stmt -> bind_param('s', $userid);
        $stmt -> execute();
        $stmt -> store_result();
        $stmt -> bind_result($n, $f);
        $stmt -> fetch();
    }

    //return amount
    if ($outputamountF < 0) $outputamountF = 0;
    if ($outputamountN < 0) $outputamountN =0;
    
    echo $message . "/". $outputamountN . "/" . $outputamountF . "/" . $n . "/" . $f . "/" . ($n + $f);
}
?>