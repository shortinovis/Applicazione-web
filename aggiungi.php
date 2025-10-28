<?php
if(session_status() == PHP_SESSION_NONE) session_start();
require_once("funzioni.php");
require_once("Persona.php");

if (!isset($_SESSION["UserLogin"])) {
    header("location: logAcc.php");
    exit();
}

$pagina_form = '
<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aggiungi Persona</title>
    <link rel="stylesheet" href="../style/style.css">
</head>
<body>
    <div class="container">
        <h1>Aggiungi Persona</h1>
        <form action="aggiungi.php" method="post">
            <label for="nome">Nome</label>
            <input type="text" name="nome" required>
            <label for="cognome">Cognome</label>
            <input type="text" name="cognome" required>
            <label for="data_nascita">Data di nascita</label>
            <input type="date" name="data_nascita" required>
            <label for="codice_fiscale">Codice Fiscale</label>
            <input type="text" name="codice_fiscale" required>
            <div class="btn-container">
                <input type="submit" value="Aggiungi">
                <input type="reset" value="Cancella">
            </div>
        </form>
        <a href="../dashboard.php"><button>Torna alla Dashboard</button></a>
    </div>
</body>
</html>
';

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    echo $pagina_form;
    exit();
}

if (
    isset($_POST["nome"], $_POST["cognome"], $_POST["data_nascita"], $_POST["codice_fiscale"]) &&
    !empty(trim($_POST["nome"])) &&
    !empty(trim($_POST["cognome"])) &&
    !empty(trim($_POST["data_nascita"])) &&
    !empty(trim($_POST["codice_fiscale"]))
) {
    $persona = new Persona(
        trim($_POST["nome"]),
        trim($_POST["cognome"]),
        $_POST["data_nascita"],
        strtoupper(trim($_POST["codice_fiscale"]))
    );

    $persone = letturaFile("data.txt");
    if (!is_array($persone)) $persone = [];

    $persone[] = $persona->toArray();
    scritturaFile("data.txt", $persone);

    header("location: dashboard.php");
    exit();
} else {
    echo $pagina_form;
}
?>
