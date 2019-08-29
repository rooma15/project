<?php
session_start();
include_once("auction_class.php");
$mysqli = new mysqli('localhost', 'root', '', 'mybase');
$auctions = $mysqli->query("SELECT * FROM auctions");
$arr = array();
$i = 0;
while($result = $auctions->fetch_assoc())
{
    $e = new auction($result['id'], $result['name'], $result['surname'],$result['description'], 'img/auctions/'.$result['name'].'_'.$result['surname'].'.png', $result['exp_time']);
    $e = $e->json_type();
    array_push($arr, $e);
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <script src="js/jquery-3-3-1-min.js"></script>
    <link href="style.css" rel="stylesheet">
    <script src="script.js"></script>
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<style>
    button{
        left: 0;
        top: 0;
        background-color: #ed11fa;
        padding: 15px;
        color: white;
        text-decoration: none;
        font-weight: bold;
        cursor: pointer;
    }
    .connection, .connection:visited, .connection:hover{
        position: absolute;
        right: 0;
        top: 0;
        background-color: #ed11fa;
        padding: 15px;
        color: white !important;
        text-decoration: none;
        font-weight: bold;
    }
    body{
        color: black !important;
    }
    a, a:visited{
        color: black !important;
    }
</style>
<form id="signOutForm">
    <button>выйти</button>
</form>
<a href="admin.php" class="connection">добавить аукционы</a>
<?if(isset($_SESSION['admin'])):?>
<div class="container-fluid auctions">
    <?for($i=0;$i < count($arr);$i++):?>
        <div class="row auct">
            <div class="col-3 text-center">
                <img src="<?=$arr[$i]['src']?>" class="auction_img"><br>
                <h4><?=$arr[$i]['name']?>  <?=$arr[$i]['surname']?></h4>
            </div>
            <div class="col-6">
                <span class="last_bets_text"><?=$arr[$i]['description']?></span>
                <?for($j=0; $j < count($values_mass);$j++):?><?if($values_mass[$j]['auction_id'] == $arr[$i]['id'] && $arr[$i]['counter'] <3):?><span class="last_bets"><?=$values_mass[$j]['value']?><?$arr[$i]['counter']++;?></span>&nbsp;&nbsp;&nbsp;<?endif?><?endfor?>
            </div>
            <div class="col-2 pt-2 text-center">
               <a onclick="delete_auct(<?=$arr[$i]['id']?>)" href="#">Удалить</a> | <a onclick="edit()" href="edit_page.php?id=<?=$arr[$i]['id']?>">Реадктировать</a>
            </div>
        </div>
    <?endfor;?>
</div>
<script>
    function delete_auct(id)
    {
        if(!confirm("Вы точно хотите удалить этот аукцион ?"))
        {
            return false;
        }
        $.ajax
        (
            {
                url: "delete.php",
                type: "post",
                dataType: "json",
                data:{id:id},
                success:function(data)
                {
                    alert("Удаление прошло успешно:)");
                    location.reload();
                },
                error:function(data)
                {
                    alert("Удаления не случилось((");
                }
            }
        )
    }
</script>
<?endif;?>
<?if(!isset($_SESSION['admin'])):?>
    <form id="checkAdmin"  method="post" action="admin_login.php">
        <div class="container main_popup_out">
            <div class="text-center main_popup_in">
                <p><input type="text" name="Login" placeholder="Логин" class="input_popup" id="login" autocomplete="off"></p>
                <p><input type="password" name="Password" placeholder="Пароль" class="input_popup" id="password"></p>
                <p><input type="submit" value="ВОЙТИ"></p>
            </div>
        </div>
        <div class="blur"></div>
    </form>
    <script>
        var height = window.innerHeight * 0.15 + window.pageYOffset;
        $(".blur").css("display", "block");
        $(".blur").css("margin-top", window.pageYOffset + "px");
        $(".main_popup_out").css("margin-top", height + "px");
        $(".main_popup_out").css("display", "block");
        $("#checkAdmin").submit(function(e)
        {
            e.preventDefault();
            $.ajax
            (
                {
                    url: "admin_login.php",
                    type: "post",
                    dataType: "json",
                    data: $("#checkAdmin").serialize(),
                    complete:function(data)
                    {
                        location.reload();
                    }
                }
            )
        })
    </script>
<?endif;?>
<script src="/js/bootstrap.min.js"></script>
</body>
</html>
