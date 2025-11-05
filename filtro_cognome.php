<?php
session_start();
if (!isset($_SESSION['user'])) { header('Location: index.html'); exit; }
$cognome = trim($_GET['cognome'] ?? '');
$file='persone.json';
$people = file_exists($file) ? json_decode(file_get_contents($file), true) : [];
$matches = array_values(array_filter($people, function($p) use($cognome){ return stripos($p['cognome'],$cognome)!==false; }));
?>
<!doctype html><html><head><meta charset="utf-8"><title>Risultati</title><link rel="stylesheet" href="style.css"></head><body>
<h1>Risultati per "<?php echo htmlspecialchars($cognome) ?>"</h1>
<div class="list">
  <a href="dashboard.php">Dashboard</a> | <a href="persone.php">Lista completa</a>
  <ul>
  <?php foreach ($matches as $p): ?>
    <li><?php echo htmlspecialchars($p['cf']).' - '.htmlspecialchars($p['nome'].' '.$p['cognome']).' ('.htmlspecialchars($p['data_nascita']).')' ?></li>
  <?php endforeach; ?>
  </ul>
</div>
</body></html>
