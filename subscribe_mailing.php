<?php
$mysqli = new mysqli("localhost", "root", "", "mybase");
$temp = $mysqli->query("SELECT * FROM subscribers");
$subscribers = array();
$text = "<html><body><span style='color: red;'>привет</span></body></html>";
while($subscriber = $temp->fetch_assoc()){
    $headers = 'From:' . "paypalpurc@gmail.com";
    mail($subscriber['email'], "subscriber mailing", $text, $headers);
}



