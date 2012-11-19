<?php
set_include_path($_SERVER['DOCUMENT_ROOT']);
include 'dashboard/include/db_connect.php';

$deckid = $_POST['deckid'];

if ($update_stmt = $mysqli -> prepare("UPDATE user_decks SET isFavorite = !isFavorite WHERE id = ?;")) {
    $update_stmt -> bind_param('s', $deckid);
    $update_stmt -> execute();
}

if ($stmt = $mysqli -> prepare("SELECT isFavorite FROM user_decks WHERE id = ?")) {
    $stmt -> bind_param('s', $deckid);
    $stmt -> execute();
    $stmt -> store_result();
    $stmt -> bind_result($fav);
    $stmt -> fetch();
}
echo $fav;
?>