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

$results = [];
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $cogn = trim($_POST['cognome'] ?? '');
    if ($cogn !== '') {
        $people = leggi_persone();
        foreach ($people as $p) {
            if (isset($p['cognome']) && strcasecmp($p['cognome'], $cogn) === 0) {
                $results[] = $p;
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="it">
<head>
  <meta charset="utf-8">
  <title>Filtra per cognome</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <main class="card">
    <h1>Filtra per cognome</h1>
    <form method="post" class="filter-form">
      <input type="text" name="cognome" placeholder="Inserisci cognome" required>
      <button type="submit">Cerca</button>
      <a class="link" href="dashboard.php">Dashboard</a>
    </form>

    <?php if (!empty($results)): ?>
      <table>
        <thead><tr><th>CF</th><th>Nome</th><th>Cognome</th><th>Data</th></tr></thead>
        <tbody>
        <?php foreach ($results as $r): ?>
          <tr>
            <td><?= htmlspecialchars($r['cf'] ?? '', ENT_QUOTES) ?></td>
            <td><?= htmlspecialchars($r['nome'] ?? '', ENT_QUOTES) ?></td>
            <td><?= htmlspecialchars($r['cognome'] ?? '', ENT_QUOTES) ?></td>
            <td><?= htmlspecialchars($r['data_nascita'] ?? '', ENT_QUOTES) ?></td>
          </tr>
        <?php endforeach; ?>
        </tbody>
      </table>
    <?php elseif ($_SERVER['REQUEST_METHOD'] === 'POST'): ?>
      <p class="small">Nessuna corrispondenza trovata.</p>
    <?php endif; ?>
  </main>
</body>
</html>
