<?php
function letturaFile($file_path) {
    if (!file_exists($file_path)) return [];
    $contenuto = file_get_contents($file_path);
    $dati = json_decode($contenuto, true);
    return is_array($dati) ? $dati : [];
}

function scritturaFile($file_path, $dati) {
    file_put_contents($file_path, json_encode($dati, JSON_PRETTY_PRINT));
}

function controlloUP($user, $pass) {
    $utenti = letturaFile("user.txt");
    return isset($utenti[$user]) && password_verify($pass, $utenti[$user]);
}
?>
