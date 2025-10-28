<?php
session_start();
require_once("funzioni.php");

$pagina_errore = file_get_contents("logAcc.php");

if (
    isset($_POST["username"]) && !empty(trim($_POST["username"])) &&
    isset($_POST["password"]) && !empty(trim($_POST["password"]))
) {
    $username = trim($_POST["username"]);
    $password = trim($_POST["password"]);

    if (controlloUP($username, $password)) {
        $_SESSION["UserLogin"] = $username;
        header("Location: dashboard.php");
    } else {
        echo $pagina_errore;
    }
} else {
    echo $pagina_errore;
}
?>
