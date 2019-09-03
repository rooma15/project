<?php
if(isset($_POST['id']))$id = $_POST['id'];
$mysqli = new mysqli('localhost', 'root', '', 'mybase');
$del_photo = $mysqli->prepare("SELECT name, surname FROM auctions WHERE id=?");
$del_photo->bind_param("i", $id);
$del_photo->execute();
$del_photo = $del_photo->get_result();
$result = $del_photo->fetch_assoc();
$name = $result['name'];
$surname = $result['surname'];
$delete = $mysqli->prepare("DELETE FROM auctions WHERE id=?");
$delete->bind_param("i", $id);
if(!$delete->execute())header("HTTP/1.0 403 Forbidden");
else
{
    $src = "img/auctions/" . $name . "_" . $surname . ".png";
    unlink($src);
    echo true;
}
$bets = $mysqli->prepare("DELETE FROM bets WHERE auction_id=?");
$bets->bind_param("i", $id);
if(!$bets->execute())header("HTTP/1.0 403 Forbidden");
else echo true;
$mysqli->close();