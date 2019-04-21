<?php
session_start();
session_destroy();
setcookie("email","",time()-1);
if(isset($_COOKIE["password"])){
    setcookie("password","",time()-1);
}
header('Location: login.php');
?>