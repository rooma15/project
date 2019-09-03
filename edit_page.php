<?php
session_start();
$id = $_GET['id'];
$mysqli = new mysqli('localhost', 'root', '', 'mybase');
$info = $mysqli->prepare("SELECT * FROM auctions WHERE id=?");
$info->bind_param("i", $id);
$info->execute();
$info = $info->get_result();
$result = $info->fetch_assoc();
$src = "img/auctions/" . $result['name'] . "_" . $result['surname'] . ".png";
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <script src="js/jquery-3-3-1-min.js"></script>
    <link href="style.css" rel="stylesheet">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<?if(isset($_SESSION['admin'])):?>
    <style>
        img{
            width: 150px;
            height: 230px;
        }
        img, input, textarea{
            margin-bottom: 40px;
        }
        .connection, .connection:visited, .connection:hover, .edit{
            background-color: #ed11fa;
            padding: 15px;
            color: white;
            text-decoration: none;
            font-weight: bold;
        }
    </style>
    <div class="container">
        <div class="row justify-content-center">
            <form id="updateAuct" enctype="multipart/form-data" action="update_info.php" method="post">
                <img src="<?=$src?>" class="auction_img img-fluid">
                <input type="file" name="file" id="fileId"><br>
                <input name="name" type="text" value="<?=$result['name']?>"><br>
                <input name="surname" type="text" value="<?=$result['surname']?>"><br>
                <textarea name="description"><?=$result['description']?></textarea><br>
                <input type="datetime-local" name="date" value="<?=date('Y-m-d\TH:i', $result['exp_time'])?>"><br>
                <input type="submit" value="изменить" class="edit"><br>
                <a href="edit.php" class="connection">отменить редактирование</a>
            </form>
        </div>
    </div>
    <script>
        $("#updateAuct").submit(function(e)
        {
            e.preventDefault();
            var file_data = $('#fileId').prop('files')[0];
            var Postdata = new FormData($("#updateAuct")[0]);
            Postdata.append('file', file_data);
            Postdata.append('id', <?=$id?>);
            $.ajax
            (
                {
                    url: "update_info.php",
                    dataType: "json",
                    processData: false,
                    contentType: false,
                    type: "post",
                    data:Postdata,
                    success:function(data)
                    {
                        alert("Информация была обновлена");
                        location.href = "edit.php";
                    },
                    error:function(data)
                    {
                        alert("произошла ошибка");
                    }
                }
            )
        })
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
    <script src="js/bootstrap.min.js"></script>
</body>
</html>
