<?php
$users_file = 'users.json';
$users = file_exists($users_file) ? json_decode(file_get_contents($users_file), true) : [];

$username = trim($_POST['username'] ?? '');
$password = $_POST['password'] ?? '';

if ($username === '' || $password === '') {
    die('Tutti i campi sono obbligatori. <a href="registro.html">Indietro</a>');
}
foreach ($users as $u) {
    if ($u['username'] === $username) {
        die('Username già esistente. <a href="registro.html">Indietro</a>');
    }
}
$users[] = ['username'=>$username,'password'=>$password];
file_put_contents($users_file, json_encode($users, JSON_PRETTY_PRINT));
header('Location: index.html');
exit;
?>