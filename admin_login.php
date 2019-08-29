<?php
session_start();
if(isset($_POST['Login']) && isset($_POST['Password']))
{
    if($_POST['Login'] == "root" && $_POST['Password'] == "root")
    {
        $_SESSION['admin'] = "admin";
    }
}