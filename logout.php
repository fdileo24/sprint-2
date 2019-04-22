<?php
session_start();
if (empty($_SESSION["email"])){
    header('Location: login.php');
}else{
    session_destroy();
    if(isset($_COOKIE["email"])){
        setcookie("email","",time()-1);
    }
    header('Location: index.php');
}
?>