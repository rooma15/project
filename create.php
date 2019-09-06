<?php
if($_POST['name']!="")$name = trim($_POST['name']);
if($_POST['surname']!="")$surname = trim($_POST['surname']);
if($_POST['description']!="")$description = trim($_POST['description']);
$tmp_name = $_FILES['file']['tmp_name'];
$file_name = "img/auctions/" . $name . "_" . $surname . ".png";
move_uploaded_file($tmp_name, $file_name);
if($_POST['date']!="")$exp_time = strtotime($_POST['date']);
$mysqli = new mysqli('localhost', 'root', '', 'mybase');
$insert = $mysqli->prepare("INSERT INTO auctions VALUES(NULL, ?, ?, ?, ?)");
if(!$insert->bind_param("sssi", $name, $surname, $description, $exp_time)){
    header("HTTP/1.0 403 Forbidden");
    exit;
}
if(!$insert->execute()){
    header("HTTP/1.0 403 Forbidden");
    exit;
}
$temp = $mysqli->query("SELECT email FROM subscribers");
while($subscriber = $temp->fetch_assoc()){
    $headers = "Content-type: text/html;\r\n";
    $headers .= "From: <dalia@support.com>\r\n";
    $headers .= "Reply-To: timeforcharity@support.com\r\n";
    $text = "
<html>
    <body>
        <span style='color: red;'>привет</span>
    </body>
</html>";
    mail($subscriber['email'], "support message", $text, $headers);
}
?>