<?php
session_start();
if (!isset($_SESSION['user'])) { header('Location: index.html'); exit; }
$file='persone.json';
$people = file_exists($file) ? json_decode(file_get_contents($file), true) : [];
?>
<!doctype html><html><head><meta charset="utf-8"><title>Persone</title><link rel="stylesheet" href="style.css"></head><body>
<h1>Elenco Persone</h1>
<div class="list">
  <a href="dashboard.php">Torna alla Dashboard</a> | <a href="aggiungi_persona.html">Aggiungi nuova</a>
  <ul>
  <?php foreach ($people as $p): ?>
    <li><?php echo htmlspecialchars($p['cf']) ?> - <?php echo htmlspecialchars($p['nome'].' '.$p['cognome']) ?> (<?php echo htmlspecialchars($p['data_nascita']) ?>)
      - <a href="modifica_persone.php?cf=<?php echo urlencode($p['cf']) ?>">Modifica</a>
      - <a href="elimina_persone.php?cf=<?php echo urlencode($p['cf']) ?>" onclick="return confirm('Sei sicuro?')">Elimina</a>
    </li>
  <?php endforeach; ?>
  </ul>
</div>
</body></html>
