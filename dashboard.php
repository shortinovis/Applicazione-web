<?php
session_start();
if (!isset($_SESSION['user'])) { header('Location: index.html'); exit; }
?>
<!doctype html>
<html><head><meta charset="utf-8"><title>Dashboard</title><link rel="stylesheet" href="style.css"></head>
<body>
  <h1>Dashboard</h1>
  <div class="box">
    <p>Benvenuto, <?php echo htmlspecialchars($_SESSION['user']); ?>. <a href="logout.php">Logout</a></p>
    <ul>
      <li><a href="aggiungi_persona.html">Aggiungi persona</a></li>
      <li><a href="persone.php">Vedi tutte le persone</a></li>
      <li><a href="filtro_cognome.html">Cerca per cognome</a></li>
      <li><a href="filtro_data.html">Persone nate dopo data</a></li>
    </ul>
  </div>
</body></html>
