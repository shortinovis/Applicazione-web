<?php
session_start();

// semplice helper per leggere utenti dal .txt
function leggi_utenti(): array {
    $f = 'utenti.txt';
    if (!file_exists($f)) return [];
    $txt = file_get_contents($f);
    $arr = json_decode($txt, true);
    return is_array($arr) ? $arr : [];
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user = trim($_POST['username'] ?? '');
    $pass = trim($_POST['password'] ?? '');

    $users = leggi_utenti();

    foreach ($users as $u) {
        if (isset($u['username'], $u['password']) && $u['username'] === $user && $u['password'] === $pass) {
            // login ok
            $_SESSION['username'] = $user;
            header('Location: dashboard.php');
            exit;
        }
    }

    // login fallito -> torna indietro con messaggio (semplice)
    header('Location: index.html');
    exit;
}

// se accesso diretto via GET, reindirizza al form
header('Location: index.html');
exit;
