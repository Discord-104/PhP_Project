<?php
    require_once("classi/Ordine.php");
    session_start();
    
    
    if (!isset($_GET["nome"]) || !isset($_GET["cognome"]) || !isset($_GET["classe"])) {
        header("location: index.php?messaggio=devi compilare tutti i campi");
        exit();
    } else {
        $nome = $_GET['nome'];
        $cognome = $_GET['cognome'];
        $classe = $_GET['classe'];

        $_SESSION['ordine'] = new Ordine($nome, $cognome, $classe);
    }
?>

<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Seleziona il tuo pasto</title>
    <link rel="stylesheet" href="CSS/style.css">
</head>
<body>
    <header>
        <h1>Ordina il tuo ultimo pasto nel mio Bar (scarto della società)</h1>
    </header>
    <section>
        <h1>Seleziona il tuo pasto</h1>
        <form method="GET" action="scelta_bevanda.php">
            <label for="pasto">Pasto:</label>
            <select name="pasto" required>
                <option value="Focaccia">Focaccia</option>
                <option value="Pizza">Pizza</option>
                <option value="Panino">Panino</option>
            </select><br><br>

            <input type="submit" value="Prosegui">
        </form>
    </section>
    <footer>
        <p>&copy; 2024 Il mio Bar (non fare il furbo ho il tuo indirizzo IP)</p>
    </footer>
</body>
</html>
