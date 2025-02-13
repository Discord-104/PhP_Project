<?php
    if(!isset($_SESSION)){
        session_start();
    }
?>

<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inserisci i tuoi dati</title>
    <link rel="stylesheet" href="CSS/style.css">
</head>
<body>
    <?php
        if (isset($_GET["messaggio"])) {
            echo "<h1 style='color:red'>".$_GET["messaggio"]."</h1>";
        }
    ?>
    <header>
        <h1>Benvenuto al mio Bar (sfigato)</h1>
    </header>
    <section>
        <form method="GET" action="scelta_pasto.php">
            <label for="nome">Nome:</label>
            <input type="text" name="nome" required><br>

            <label for="cognome">Cognome:</label>
            <input type="text" name="cognome" required><br>

            <label for="classe">Classe:</label>
            <input type="text" name="classe" required><br>

            <br>

            <input type="submit" value="Prosegui">
        </form>
    </section>
    <footer>
        <p>&copy; 2024 Il mio Bar (prova solo a rubare il mio sito, e ti spedisco la mafia rumena sotto casa tua)</p>
    </footer>
</body>
</html>
