<?php
session_start();
require_once 'funzioni.php'; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);
    $password2 = trim($_POST['password2']);

    if ($password !== $password2) {
        echo "<script>alert('Le password non coincidono!'); window.location.href='reg.html';</script>";
        exit();
    }

   
    $conn = new mysqli("localhost", "root", "", "tuo_database");

    if ($conn->connect_error) {
        die("Connessione fallita: " . $conn->connect_error);
    }

    $check = $conn->prepare("SELECT username FROM utenti WHERE username = ?");
    $check->bind_param("s", $username);
    $check->execute();
    $check->store_result();

    if ($check->num_rows > 0) {
        echo "<script>alert('Utente già registrato!'); window.location.href='reg.html';</script>";
        $check->close();
        $conn->close();
        exit();
    }


    $hash = password_hash($password, PASSWORD_DEFAULT);
    $stmt = $conn->prepare("INSERT INTO utenti (username, password) VALUES (?, ?)");
    $stmt->bind_param("ss", $username, $hash);

    if ($stmt->execute()) {
        $_SESSION['username'] = $username;
        header("Location: dashboard.php");
        exit();
    } else {
        echo "<script>alert('Errore nella registrazione'); window.location.href='reg.html';</script>";
    }

    $stmt->close();
    $conn->close();
}
?>
