<?php
set_include_path($_SERVER['DOCUMENT_ROOT']);
include 'dashboard/include/db_connect.php';

$cardid = $_POST['cardid'];
$userid = $_POST['userid'];
$amountN = $_POST['amountn'];
$amountF = $_POST['amountf'];

if ($amountN != 0 || $amountF != 0) {

	if ($stmt = $mysqli -> prepare("SELECT id, tradeamount_normal, tradeamount_foil FROM user_cardcollection WHERE userid = ? AND cardid = ?")) {
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
			if ($update_stmt = $mysqli -> prepare("UPDATE user_cardcollection SET tradeamount_normal = ?, tradeamount_foil = ? WHERE id = ?;")) {
				$update_stmt -> bind_param('sss', $tn, $tf, $id);
				$update_stmt -> execute();

				$outputamountN = $tn;
				$outputamountF = $tf;
			}
		}
	}
}
?>