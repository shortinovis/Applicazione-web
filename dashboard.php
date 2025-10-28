<?php
session_start();
if (!isset($_SESSION['username'])) {
    header('Location: index.html');
    exit;
}
?>
<!DOCTYPE html>
<html lang="it">
<head>
  <meta charset="utf-8">
  <title>Dashboard</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <main class="card">
    <h1>Benvenuto <?= htmlspecialchars($_SESSION['username'], ENT_QUOTES) ?></h1>
    <ul>
      <li><a href="aggiungi_persona.html" class="link">Aggiungi persona</a></li>
      <li><a href="persone.php" class="link">Visualizza persone</a></li>
      <li><a href="filtro_cognome.php" class="link">Filtra per cognome</a></li>
      <li><a href="filtro_data.php" class="link">Filtra per data di nascita</a></li>
      <li><a href="logout.php" class="link">Logout</a></li>
    </ul>
  </main>
</body>
</html>
