<?php
$email = trim($_POST['email']);
$text = $_POST['msg'];
$msg = array();
if($email == '' || !preg_match('/^(([a-zA-Z0-9_\-.]+)@([a-zA-Z0-9\-]+)\.[a-zA-Z0-9\-.]+$)/', $email))array_push($msg, array("error_code"=>"email"));
if($text == "")array_push($msg, array("error_code"=>"msg"));
if(empty($msg))
    {
        $headers = 'From:' . $email;
        if(!mail("example@gmail.com", "support message", $text, $headers))header("HTTP/1.0 404 Not Found");
        else echo json_encode($msg);
    }else
        {
            echo json_encode($msg);
        }
