<?php
session_start();
if (!isset($_SESSION['user'])) { header('Location: index.html'); exit; }
$file='persone.json';
$people = file_exists($file) ? json_decode(file_get_contents($file), true) : [];
$cf = $_GET['cf'] ?? '';
$found=false;
foreach ($people as $i=>$p) {
    if ($p['cf'] === $cf) { array_splice($people,$i,1); $found=true; break; }
}
if ($found) file_put_contents($file, json_encode($people, JSON_PRETTY_PRINT));
header('Location: persone.php'); exit;
?>