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
    $from = $_POST['from'] ?? '';
    $to = $_POST['to'] ?? '';
    if ($from !== '' && $to !== '') {
        $people = leggi_persone();
        foreach ($people as $p) {
            if (isset($p['data_nascita'])) {
                $d = $p['data_nascita'];
                if ($d >= $from && $d <= $to) {
                    $results[] = $p;
                }
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="it">
<head>
  <meta charset="utf-8">
  <title>Filtra per data</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <main class="card">
    <h1>Filtra per data di nascita</h1>
    <form method="post" class="filter-form">
      <label><span class="small">Da</span><input type="date" name="from" required></label>
      <label><span class="small">A</span><input type="date" name="to" required></label>
      <button type="submit">Applica</button>
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
      <p class="small">Nessuna persona trovata nell'intervallo selezionato.</p>
    <?php endif; ?>
  </main>
</body>
</html>
