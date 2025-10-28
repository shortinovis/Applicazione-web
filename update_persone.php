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
    $cf_old = $_POST['cf_old'] ?? '';
    $cf = trim($_POST['cf'] ?? '');
    $nome = trim($_POST['nome'] ?? '');
    $cognome = trim($_POST['cognome'] ?? '');
    $data_nascita = trim($_POST['data_nascita'] ?? '');

    if ($cf_old === '') {
        header('Location: persone.php');
        exit;
    }

    $people = leggi_persone();
    foreach ($people as &$p) {
        if (isset($p['cf']) && $p['cf'] === $cf_old) {
            $p['cf'] = $cf;
            $p['nome'] = $nome;
            $p['cognome'] = $cognome;
            $p['data_nascita'] = $data_nascita;
            break;
        }
    }
    unset($p);
    scrivi_persone($people);

    header('Location: persone.php');
    exit;
}

header('Location: persone.php');
exit;
