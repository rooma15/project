<?php
session_start();
$mysqli = new mysqli('localhost', 'root', '', 'mybase');
$errors = array();
function compare_POST($a, $b, mysqli &$mysqli, &$mass)
{
    $base = $mysqli->prepare("SELECT $a FROM users WHERE $a=?");
    $base->bind_param("s", $b);
    $base->execute();
    $base = $base->get_result();
    $result = $base->fetch_assoc();
    if(isset($result[$a]))array_push($mass, array("error_code"=>$a, "error_msg"=>"" . $a." is already exist"));
}

if($_POST['name']!="") $name = $_POST['name'];
else array_push($errors, array("error_code"=>"name"));
if ($_POST['surname'] != "")$surname = $_POST['surname'];
else array_push($errors, array("error_code"=>"surname"));
if (strlen($_POST['password']) >= 8) $password = $_POST['password'];
else array_push($errors, array("error_code"=>'password', "error_msg"=>"password must be 8 symbols or longer"));
if ($_POST['email'] != "")
{
    if(!preg_match('/^(([a-zA-Z0-9_\-.]+)@([a-zA-Z0-9\-]+)\.[a-zA-Z0-9\-.]+$)/', $_POST['email'])){
        array_push($errors, array("error_code"=>'email', "error_msg"=>"Please write valid email"));
    }else {
        $email = $_POST['email'];
        compare_POST('email', $email, $mysqli, $errors);
    }
}
else array_push($errors, array("error_code"=>"email"));
if ($_POST['phone'] != "") $phone = $_POST['phone'];
else array_push($errors, array("error_code"=>"phone"));
if(!empty($errors)){
    $errors['status'] = "error";
    $errors['size'] = count($errors);
}
else {
    $errors['status'] = "OK";
    $errors['size'] = 0;
}

$result = $mysqli->prepare("INSERT INTO users (id, name, surname, email, passwd, phone) VALUES(NULL, ?, ?, ?, ?, ?)");
echo $mysqli->error;
$result->bind_param('sssss', $name ,$surname ,$email ,$password ,$phone);
$result->execute();
$mysqli->close();
if($errors['status'] == "OK"){
    $_SESSION['name'] = $name;
}
echo json_encode($errors);
?>