<?php
$mysqli = new mysqli('localhost', 'root', '', 'mybase');
$base = $mysqli->query("SELECT * FROM auctions");
while($result = $base->fetch_assoc())
{
    if($result['exp_time'] <= time())
    {
        $bets = $mysqli->prepare("SELECT value, user_id FROM bets WHERE auction_id=? ORDER BY value DESC");
        $bets->bind_param("i", $result['id']);
        $bets->execute();
        $bets = $bets->get_result();
        $max_bet = $bets->fetch_assoc();


        $name = $result['name'];
        $surname = $result['surname'];
        $description = $result['description'];
        $price = $max_bet['value'];
        if(isset($max_bet['user_id'])){
            $owner = $max_bet['user_id'];
            $insert = $mysqli->prepare("INSERT INTO unpayed VALUES(NULL, ?, ?, ?, ?, ?)");
            $insert->bind_param("sssii", $name, $surname, $description, $price, $owner);
            $insert->execute();
        }



        /*$delete_bets = $mysqli->prepare("DELETE FROM bets WHERE auction_id=?");
        $delete_bets->bind_param("i", $result['id']);
        $delete_bets->execute();*/


        $delete = $mysqli->prepare("DELETE FROM auctions WHERE id=?");
        $delete->bind_param('i', $result['id']);
        $delete->execute();
    }
}

