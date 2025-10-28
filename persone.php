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

$people = leggi_persone();
?>
<!DOCTYPE html>
<html lang="it">
<head>
  <meta charset="utf-8">
  <title>Elenco persone</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <main class="card">
    <h1>Elenco persone</h1>
    <div class="small">Totale: <?= count($people) ?></div>
    <?php if (count($people) === 0): ?>
      <p class="small">Non ci sono persone registrate.</p>
    <?php else: ?>
      <table>
        <thead>
          <tr><th>CF</th><th>Nome</th><th>Cognome</th><th>Data nascita</th><th>Azioni</th></tr>
        </thead>
        <tbody>
        <?php foreach ($people as $p): ?>
          <tr>
            <td><?= htmlspecialchars($p['cf'] ?? '', ENT_QUOTES) ?></td>
            <td><?= htmlspecialchars($p['nome'] ?? '', ENT_QUOTES) ?></td>
            <td><?= htmlspecialchars($p['cognome'] ?? '', ENT_QUOTES) ?></td>
            <td><?= htmlspecialchars($p['data_nascita'] ?? '', ENT_QUOTES) ?></td>
            <td class="actions-row">
              <a class="edit" href="modifica_persone.php?cf=<?= urlencode($p['cf']) ?>">Modifica</a>
              <a class="delete" href="elimina_persona.php?cf=<?= urlencode($p['cf']) ?>" onclick="return confirm('Confermi cancellazione?')">Elimina</a>
            </td>
          </tr>
        <?php endforeach; ?>
        </tbody>
      </table>
    <?php endif; ?>
    <div class="actions" style="margin-top:14px;">
      <a class="link" href="dashboard.php">Torna alla dashboard</a>
    </div>
  </main>
</body>
</html>
