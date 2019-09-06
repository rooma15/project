<?php
session_start();
?>
<!doctype html>
<html lang="en">
<head>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link href="style.css" rel="stylesheet">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <script src="js/jquery-3-3-1-min.js"></script>
    <script src="script.js"></script>
</head>
<body>
<style>
    #addAuction{
        margin-left: calc(50vw - 200px);
        padding: 80px;
        background-color: yellow;
        width: 400px;
        border-radius: 20px;
    }
    #addAuction > input, textarea{
        margin-bottom: 40px;
    }

    button{
        position: absolute;
        left: 0;
        top: 0;
        background-color: #ed11fa;
        padding: 15px;
        color: white;
        text-decoration: none;
        font-weight: bold;
        cursor: pointer;
    }
    a, a:visited, a:hover{
        position: absolute;
        right: 0;
        top: 0;
        background-color: #ed11fa;
        padding: 15px;
        color: white;
        text-decoration: none;
        font-weight: bold;
    }
    .add{
        background-color: #ed11fa;
        padding: 15px;
        color: white;
        text-decoration: none;
        font-weight: bold;
    }
</style>
<?if(isset($_SESSION['admin'])):?>
<form id="addAuction" method="post" action="create.php" enctype="multipart/form-data">
    <input name="name" type="text" placeholder="Имя Человека"><br>
    <input name="surname" type="text" placeholder="Фамилия"><br>
    <textarea name="description" placeholder="описание"></textarea><br>
    <input type="datetime-local" name="date"><br>
    <input type="file" name="file" id="fileId"><br>
    <input type="submit" value="Добавить" class="add">
    <div class="status"></div>
</form>
    <form id="signOutForm">
        <button>выйти</button>
    </form>
<a href="edit.php">редактировать аукционы</a>


<script>
    $("#addAuction").submit(function (e) {
        e.preventDefault();
        $(".status").html("<span style='color: blue;'>Подождите....</span>");
        var file_data = $('#fileId').prop('files')[0];
        var form_data =  new FormData($("#addAuction")[0]);
        form_data.append('file', file_data);
        $.ajax(
            {
                url: "create.php",
                processData: false,
                contentType: false,
                data:form_data,
                type: "post",
                success:function(data)
                {
                    $(".status").html("<span style='color: green'>Все прошло успешно</span>");
                },
                error:function(data)
                {
                    $(".status").html("<span style='color: red'>Все прошло неуспешно</span>");
                }
            }
        )
    })
</script>
<?endif?>
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



