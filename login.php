<?php
if(isset($_POST["nomeutente"])&& !empty(trim($_POST["nomeutente"])) && isset($_POST["password"])&& !empty(trim($_POST["password"]))){
    $nomeutete=trim($_POST["nomeutente"]);
    $password=trim($_POST["password"]);

    $log_arr=json_decode(file_get_contents("salvataggio.txt"), true);
    if(!is_array($logs_arr)){
        $logs_arr=[];
    }
    if(isset($logs_arr[$username]) && logs_arr[$password]===trim($password)){
        header("location: home.php");
    }else{

    }
}
?>