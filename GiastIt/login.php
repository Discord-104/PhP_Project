<?php
    session_start();

    if (isset($_SESSION["autenticato"])) {
        header("Location: paginaPrivata.php");
        exit();
    }
?>

<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="CSS/style.css">
</head>
<body>
    <header>
        <img src="IMG/Logo.jpeg" alt="Logo" class="logo">
        <h1>Benvenuto su GiastIt!</h1>
    </header>

    <main>
        <?php
            if (isset($_GET["messaggio"])) {
                echo "<h2 style='color:red'>".$_GET["messaggio"]."</h2>";
            }
        ?>

        <form action="gestoreLogin.php" method="GET">
            <div>
                <label for="username">User:</label>
                <input type="text" name="username" id="username" required>
            </div>
            <div>
                <label for="password">Password:</label>
                <input type="password" name="password" id="password" required>
            </div>
            <button type="submit">Login</button>
        </form>
    </main>

    <footer>
        <img src="IMG/Logo.jpeg" alt="Logo" class="logo-copyright">
        &copy; 2024 GiastIt. Tutti i diritti riservati.
    </footer>
</body>
</html>
