<?php
if($_POST['name']!="")$name = $_POST['name'];
if($_POST['surname']!="")$surname = $_POST['surname'];
if($_POST['description']!="")$description = $_POST['description'];
$tmp_name = $_FILES['file']['tmp_name'];
$file_name = "img/auctions/" . $name . "_" . $surname . ".png";
move_uploaded_file($tmp_name, $file_name);
if($_POST['date']!="")$exp_time = strtotime($_POST['date']);
$mysqli = new mysqli('localhost', 'root', '', 'mybase');
$insert = $mysqli->prepare("INSERT INTO auctions VALUES(NULL, ?, ?, ?, ?)");
if(!$insert->bind_param("sssi", $name, $surname, $description, $exp_time))header("HTTP/1.0 403 Forbidden");
if(!$insert->execute())header("HTTP/1.0 403 Forbidden");
?>