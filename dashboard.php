<?php
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: logAcc.php");
    exit();
}

$username = $_SESSION['username'];
?>

<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="style/style.css">
</head>
<body>
    <div class="container">
        <h1>Benvenuto, <?php echo htmlspecialchars($username); ?>!</h1>
        <p>Hai effettuato l'accesso con successo.</p>

        <div class="btn-container">
            <a href="logout.php"><button>Logout</button></a>
        </div>
    </div>
</body>
</html>
