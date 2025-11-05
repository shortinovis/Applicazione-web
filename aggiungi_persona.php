<?php
session_start();
if (!isset($_SESSION['user'])) { header('Location: index.html'); exit; }

$file = 'persone.json';
$people = file_exists($file) ? json_decode(file_get_contents($file), true) : [];

$cf = trim($_POST['cf'] ?? '');
$nome = trim($_POST['nome'] ?? '');
$cognome = trim($_POST['cognome'] ?? '');
$data = trim($_POST['data_nascita'] ?? '');

if ($cf===''||$nome===''||$cognome===''||$data==='') {
    die('Tutti i campi sono obbligatori. <a href="aggiungi_persona.html">Indietro</a>');
}
foreach ($people as $p) {
    if ($p['cf'] === $cf) {
        die('CF già presente. <a href="aggiungi_persona.html">Indietro</a>');
    }
}
$people[] = ['cf'=>$cf,'nome'=>$nome,'cognome'=>$cognome,'data_nascita'=>$data];
file_put_contents($file, json_encode($people, JSON_PRETTY_PRINT));
header('Location: persone.php');
exit;
?>