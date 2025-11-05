<?php
session_start();
if (!isset($_SESSION['user'])) { header('Location: index.html'); exit; }
$file='persone.json';
$people = file_exists($file) ? json_decode(file_get_contents($file), true) : [];

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $cf = $_GET['cf'] ?? '';
    $found = null;
    foreach ($people as $p) { if ($p['cf']===$cf) { $found=$p; break; } }
    if (!$found) { die('Persona non trovata. <a href="persone.php">Indietro</a>'); }
    ?>
    <!doctype html><html><head><meta charset="utf-8"><title>Modifica</title><link rel="stylesheet" href="style.css"></head><body>
    <h1>Modifica Persona</h1>
    <div class="box">
    <form method="POST" action="modifica_persone.php">
      <input type="hidden" name="original_cf" value="<?php echo htmlspecialchars($found['cf']) ?>">
      <input type="text" name="cf" value="<?php echo htmlspecialchars($found['cf']) ?>" required><br>
      <input type="text" name="nome" value="<?php echo htmlspecialchars($found['nome']) ?>" required><br>
      <input type="text" name="cognome" value="<?php echo htmlspecialchars($found['cognome']) ?>" required><br>
      <input type="date" name="data_nascita" value="<?php echo htmlspecialchars($found['data_nascita']) ?>" required><br>
      <button type="submit">Salva</button>
    </form>
    <p><a href="persone.php">Torna all'elenco</a></p>
    </div></body></html>
    <?php
    exit;
} else {
    $orig = $_POST['original_cf'] ?? '';
    foreach ($people as $i=>$p) {
        if ($p['cf'] === $orig) {
            $people[$i] = ['cf'=>$_POST['cf'],'nome'=>$_POST['nome'],'cognome'=>$_POST['cognome'],'data_nascita'=>$_POST['data_nascita']];
            file_put_contents($file, json_encode($people, JSON_PRETTY_PRINT));
            header('Location: persone.php'); exit;
        }
    }
    die('Persona non trovata. <a href="persone.php">Indietro</a>');
}
?>