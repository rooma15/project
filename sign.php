<?php
session_start();
$errors = array();
if($_POST['Login'] != "")$login = $_POST['Login'];
else array_push($errors, array("error_code"=>"login"));
if(strlen($_POST['Password']) >= 8)$password = $_POST['Password'];
else array_push($errors, array("error_code"=>"password"));

if(empty($errors))$errors['status'] = "OK";
else $errors['size'] = count($errors);

$mysqli = new mysqli('localhost', 'root', '', 'mybase');
$row = $mysqli->prepare("SELECT * FROM users WHERE login =?");
$row->bind_param("s", $login);
$row->execute();
$mysqli->commit();
$row = $row->get_result();
$result = $row->fetch_assoc();
if(password_verify($password, $result['psswd']) && $errors['status'] == "OK") {
    $name = $result['name'];
    $id = $result['id'];
    $_SESSION['name'] = $name;
    $_SESSION['id'] = $id;
    $mysqli->close();
}
else
{
    $errors['status'] = "<nobr><span style='color: red'>Неверный логин или пароль</span></nobr>";
};
echo json_encode($errors);


