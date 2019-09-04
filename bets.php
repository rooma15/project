<?php
session_start();
if(isset($_SESSION['id']))
{
    $auction_id = $_POST['id'];
    $user_id = $_SESSION['id'];
    $value = trim($_POST['value']);
    if ($value == ''){
        header('HTTP/1.1 500 Internal Server Error');
        print "Enter your bid";
        exit;
    }
    $mysqli = new mysqli("localhost", "root", "", "mybase");
    $user_name = $mysqli->prepare("SELECT name, surname FROM users WHERE id=?");
    $user_name->bind_param("i", $user_id);
    $user_name->execute();
    $user_name = $user_name->get_result();
    $user_name = $user_name->fetch_assoc();
    $user_name = $user_name['name'] . ' ' . $user_name['surname'];
    $ordered_values = $mysqli->prepare("SELECT * FROM bets WHERE auction_id=? ORDER BY value DESC");
    $ordered_values->bind_param("i", $auction_id);
    $ordered_values->execute();
    $ordered_values = $ordered_values->get_result();
    $ordered_values_mass = array();
    while ($result = $ordered_values->fetch_assoc()) {
        array_push($ordered_values_mass, $result);
    }
    if($value >= $ordered_values_mass[0]['value'] + 50){
        $insert = $mysqli->prepare("INSERT INTO bets VALUES(NULL, ?, ?, ?, ?)");
        $insert->bind_param("iiis", $user_id, $value, $auction_id, $user_name);
        if ($insert->execute()) echo true;
        else echo $mysqli->error;
        $mysqli->close();
    }
    else {
        header('HTTP/1.1 500 Internal Server Error');
        print "Your bid is too small";
    }
}
else{
    header('HTTP/1.1 500 Internal Server Error');
    print "You must be logged in";
};
