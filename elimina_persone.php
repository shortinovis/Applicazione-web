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

$cf = $_GET['cf'] ?? '';
if ($cf !== '') {
    $people = leggi_persone();
    $filtered = array_filter($people, function($p) use ($cf) {
        return !isset($p['cf']) || $p['cf'] !== $cf;
    });
    scrivi_persone(array_values($filtered));
}

header('Location: persone.php');
exit;
