<?php
$email = $_POST['email'];
if(!preg_match('/^(([a-zA-Z0-9_\-.]+)@([a-zA-Z0-9\-]+)\.[a-zA-Z0-9\-.]+$)/', $email) && $email != ""){
    echo json_encode(array("error_code"=>"wrong_email"));
    exit;
}
if($email == ""){
    echo json_encode(array("error_code"=>"no_email"));
    exit;
}
$mysqli = new mysqli("localhost", "root", "", "mybase");

$check = $mysqli->prepare("SELECT email FROM subscribers WHERE email=?");
$check->bind_param("s", $email);
$check->execute();
$check = $check->get_result();
$result = $check->fetch_assoc();
if(isset($result['email'])){
    echo json_encode(array("error_code"=>"same_email"));
    exit;
}


$insert = $mysqli->prepare("INSERT INTO subscribers VALUES(NULL, ?)");
$insert->bind_param("s", $email);
if(!$insert->execute())header("HTTP/1.0 404 Not Found");
else echo json_encode(array("error_code"=>"ok"));
$mysqli->close();