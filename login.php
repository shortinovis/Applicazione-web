<?php
session_start();
$users_file = 'users.json';
$users = file_exists($users_file) ? json_decode(file_get_contents($users_file), true) : [];
$username = $_POST['username'] ?? '';
$password = $_POST['password'] ?? '';

foreach ($users as $u) {
    if ($u['username'] === $username && $u['password'] === $password) {
        $_SESSION['user'] = $username;
        header('Location: dashboard.php');
        exit;
    }
}
die('Credenziali errate. <a href="index.html">Torna al login</a>');
?>