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

$cf = $_GET['cf'] ?? '';
$found = null;
if ($cf !== '') {
    $people = leggi_persone();
    foreach ($people as $p) {
        if (isset($p['cf']) && $p['cf'] === $cf) {
            $found = $p;
            break;
        }
    }
}

if ($found === null) {
    header('Location: persone.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="it">
<head>
  <meta charset="utf-8">
  <title>Modifica persona</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <main class="card">
    <h1>Modifica persona</h1>
    <form method="post" action="update_persone.php">
      <input type="hidden" name="cf_old" value="<?= htmlspecialchars($found['cf'], ENT_QUOTES) ?>">
      <label><span>Codice fiscale</span><input type="text" name="cf" value="<?= htmlspecialchars($found['cf'], ENT_QUOTES) ?>" required></label>
      <label><span>Nome</span><input type="text" name="nome" value="<?= htmlspecialchars($found['nome'], ENT_QUOTES) ?>" required></label>
      <label><span>Cognome</span><input type="text" name="cognome" value="<?= htmlspecialchars($found['cognome'], ENT_QUOTES) ?>" required></label>
      <label><span>Data di nascita</span><input type="date" name="data_nascita" value="<?= htmlspecialchars($found['data_nascita'], ENT_QUOTES) ?>" required></label>
      <div class="actions">
        <button type="submit">Aggiorna</button>
        <a class="link" href="persone.php">Annulla</a>
      </div>
    </form>
  </main>
</body>
</html>
