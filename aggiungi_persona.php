<?php
session_start();
if (!isset($_SESSION['username'])) {
    header('Location: index.html');
    exit;
}

function leggi_persone(): array {
    $f = 'persone.txt';
    if (!file_exists($f)) return [];
    $txt = file_get_contents($f);
    $arr = json_decode($txt, true);
    return is_array($arr) ? $arr : [];
}
function scrivi_persone(array $data): bool {
    return file_put_contents('persone.txt', json_encode(array_values($data), JSON_PRETTY_PRINT)) !== false;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $cf = trim($_POST['cf'] ?? '');
    $nome = trim($_POST['nome'] ?? '');
    $cognome = trim($_POST['cognome'] ?? '');
    $data = trim($_POST['data_nascita'] ?? '');

    if ($cf === '' || $nome === '' || $cognome === '' || $data === '') {
        header('Location: aggiungi_persona.html');
        exit;
    }

    $people = leggi_persone();

    // evita duplicati sul CF
    foreach ($people as $p) {
        if (isset($p['cf']) && $p['cf'] === $cf) {
            header('Location: aggiungi_persona.html');
            exit;
        }
    }

    $people[] = [
        'cf' => $cf,
        'nome' => $nome,
        'cognome' => $cognome,
        'data_nascita' => $data
    ];

    scrivi_persone($people);

    header('Location: persone.php');
    exit;
}

header('Location: aggiungi_persona.html');
exit;
