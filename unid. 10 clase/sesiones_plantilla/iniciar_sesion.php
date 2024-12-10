<?php
    session_start();

    if($_POST["password"] == "admin" && $_POST["password"]=="admin"){
        $_SESSION["nombre"]=$_POST["username"];
        $_SESSION["tipo"]="admin";
    }else{
        $_SESSION["nombre"]=$_POST["username"];
        $_SESSION["tipo"]="normal";
    }

    $_SESSION["nombre"] = "administrador";
    $_SESSION["tipo"] = "admin";

    header("Location:$_POST[origen]");
?>