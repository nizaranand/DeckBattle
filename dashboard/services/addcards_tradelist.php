<?php
set_include_path($_SERVER['DOCUMENT_ROOT']);
require_once 'dashboard/include/db_connect.php';

$cardid = $_POST['cardid'];
$userid = $_POST['userid'];
$amountN = $_POST['amountn'];
$amountF = $_POST['amountf'];

//add to trade
if ($amountN != 0 || $amountF != 0) {

    $outputamountN = $amountN;
    $outputamountF = $amountF;

    if ($stmt = $mysqli -> prepare("SELECT id, tradeamount_normal,tradeamount_foil,amount_normal,amount_foil FROM user_cardcollection WHERE userid = ? AND cardid = ?")) {
        $stmt -> bind_param('ss', $userid, $cardid);
        $stmt -> execute();
        $stmt -> store_result();
        $stmt -> bind_result($rowid, $dbamountN, $dbamountF,$amn,$amf);
        // get variables from result.
        $stmt -> fetch();

        if ($stmt -> num_rows > 0) {

            $tn = $dbamountN + $amountN;
            $tf = $dbamountF + $amountF;

            if ($tn < 0)
                $tn = 0;

            if ($tf < 0)
                $tf = 0;
$error = "";
if ($tn > $amn)
{
    $error = "You don't have enough of those cards in your collection.";  
}
if ($tf > $amf)
{
    $error = "You don't have enough of those cards in your collection.";  
}

if ($error == ""){
            $id = $rowid;
            if ($update_stmt = $mysqli -> prepare("UPDATE user_cardcollection SET tradeamount_normal = ?, tradeamount_foil = ? WHERE id = ?;")) {
                $update_stmt -> bind_param('sss', $tn, $tf, $id);
                $update_stmt -> execute();

                $outputamountN = $tn;
                $outputamountF = $tf;
            }
            }
        }
    }

    //return amount
    if ($outputamountF < 0) $outputamountF = 0;
    if ($outputamountN < 0) $outputamountN =0;
    
    echo $error . "/". $outputamountN . "/" . $outputamountF . "/" . $n . "/" . $f . "/0";
}
?>