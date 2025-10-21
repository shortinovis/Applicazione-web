<?php
    session_start();
    if(isset($_POST["username"]) && !empty(trim($_POST["username"])) && isset($_POST["password"]) && !empty(trim($_POST["password"]) && isset($_POST["password2"]) && !empty(trim($_POST["password2"])) && trim($_POST["password2"])===trim($_POST["password"]))){
        $username = trim($_POST["username"]);
        $password = trim($_POST["password"]);
        //lettura da file
        $logs_arr=letturaFile("data/user.txt");
        if (!isset($logs_arr[$username])){ 
            $logs_arr[$username]=password_hash($password,PASSWORD_DEFAULT); 
            scritturaFile("data/user.txt",$logs_arr);
            header("location: logAcc.php");
        } else
            echo $pagina_errore;
    } else{
        echo $pagina_errore;
    }
?>