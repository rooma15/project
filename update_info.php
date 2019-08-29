<?php
$name = $_POST['name'];
$id = $_POST['id'];
$surname = $_POST['surname'];
$description = $_POST['description'];
if(!empty($_FILES))
{
    $tmp_name = $_FILES['file']['tmp_name'];
    $file_name = "img/auctions/" . $name . "_" . $surname . ".png";
    move_uploaded_file($tmp_name, $file_name);
}

$mysqli = new mysqli('localhost', 'root', '', 'mybase');
if($_POST['date']!="")$exp_time = strtotime($_POST['date']);
else
{
    $time = $mysqli->prepare("SELECT exp_time FROM auctions WHERE id=?");
    $time->bind_param("i", $id);
    $time->execute();
    $time = $time->get_result();
    $result = $time->fetch_assoc();
    $exp_time = $result['exp_time'];
}
$update = $mysqli->prepare("UPDATE auctions SET name=?, surname=?, description=?, exp_time=? WHERE id=?");
$update->bind_param("sssii", $name,$surname, $description, $exp_time, $id);
if(!$update->execute())header("HTTP/1.0 403 Forbidden");
else echo true;
$mysqli->close();