<?php
session_start();
if(isset($_SESSION["utente"])){
    echo"aura jacket protectet ".$_SESSION["utente"];
}else{
    header("location:index2.html");
    exit();
}
?>