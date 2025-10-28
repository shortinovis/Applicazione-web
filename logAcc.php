<?php
session_start();

if (isset($_SESSION['username'])) {
    header("Location: dashboard.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    $conn = new mysqli("localhost", "root", "", "tuo_database");

    if ($conn->connect_error) {
        die("Connessione fallita: " . $conn->connect_error);
    }

    $stmt = $conn->prepare("SELECT password FROM utenti WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($hash);
        $stmt->fetch();

        if (password_verify($password, $hash)) {
            $_SESSION['username'] = $username;
            header("Location: dashboard.php");
            exit();
        } else {
            echo "<script>alert('Password errata'); window.location.href='logAcc.php';</script>";
        }
    } else {
        echo "<script>alert('Utente non trovato'); window.location.href='logAcc.php';</script>";
    }

    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="style/style.css">
    <link rel="stylesheet" href="style/style_reglog.css">
</head>
<body>
    <div class="container">
        <h1>Accedi</h1>
        <form action="logAcc.php" method="post">
            <label for="username">Nome utente</label>
            <input type="text" name="username" required>

            <label for="password">Password</label>
            <input type="password" name="password" required>

            <div class="btn-container">
                <input type="submit" value="Accedi">
                <input type="reset" value="Cancella">
            </div>
        </form>
        <a href="index.html"><button>Torna alla Home</button></a>
    </div>
</body>
</html>
