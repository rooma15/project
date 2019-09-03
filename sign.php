<?php
session_start();
if($_POST['email'] != "")$email = trim($_POST['email']);
else {
    header('HTTP/1.1 500 Internal Server Error');
    print "All fields must be filled";
    exit;
}

if($_POST['password'] != "")$password = trim($_POST['password']);
else {
    header('HTTP/1.1 500 Internal Server Error');
    print "All fields must be filled";
    exit;
}

$mysqli = new mysqli("localhost", "root", "", "mybase");
$user = $mysqli->prepare("SELECT email, passwd, id FROM users WHERE email=?");
$user->bind_param("s", $email);
$user->execute();
$user = $user->get_result();
$user = $user->fetch_assoc();
if(!empty($user)){
    if(password_verify($password, $user['passwd'])){
        $_SESSION['id'] = $user['id'];
        $mysqli->close();
        print true;
    }else{
        header('HTTP/1.1 500 Internal Server Error');
        print "Incorrect password";
        $mysqli->close();
        exit;
    };
}else{
    header('HTTP/1.1 500 Internal Server Error');
    print "User with this email does not exist";
    $mysqli->close();
    exit;
}


