<?php
session_start();

function leggi_utenti(): array {
    $f = 'utenti.txt';
    if (!file_exists($f)) return [];
    $txt = file_get_contents($f);
    $arr = json_decode($txt, true);
    return is_array($arr) ? $arr : [];
}
function scrivi_utenti(array $data): bool {
    return file_put_contents('utenti.txt', json_encode(array_values($data), JSON_PRETTY_PRINT)) !== false;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user = trim($_POST['username'] ?? '');
    $pass = trim($_POST['password'] ?? '');
    if ($user === '' || $pass === '') {
        header('Location: registro.html');
        exit;
    }

    $users = leggi_utenti();

    // semplice check duplicati
    foreach ($users as $u) {
        if (isset($u['username']) && $u['username'] === $user) {
            header('Location: registro.html');
            exit;
        }
    }

    $users[] = ['username' => $user, 'password' => $pass];
    scrivi_utenti($users);

    // dopo registrazione torna al login
    header('Location: index.html');
    exit;
}

header('Location: registro.html');
exit;
