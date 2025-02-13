<?php
    require_once("classi/Ordine.php");
    session_start();
    
    if (!isset($_SESSION['ordine'])) {
        header("Location: index.php?messaggio=Devi prima inserire i tuoi dati");
        exit();
    }

    if (isset($_GET['pasto'])) {
        $_SESSION['ordine']->setPasto($_GET['pasto']);
    } else {
        header("Location: scelta_pasto.php?messaggio=Devi selezionare un pasto");
        exit();
    }
?>

<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Seleziona la tua bevanda</title>
    <link rel="stylesheet" href="CSS/style.css">
</head>
<body>
    <header>
        <h1>Ordina la tua ultima bevanda nel mio Bar (serio perchè sei ancora qui?)</h1>
    </header>
    <section>
        <h1>Seleziona la tua bevanda</h1>
        <form method="GET" action="riepilogo.php">
            <label for="bevanda">Bevanda:</label><br>
            <input type="radio" name="bevanda" value="Fanta" required> Fanta<br>
            <input type="radio" name="bevanda" value="Coca Cola" required> Coca Cola<br>
            <input type="radio" name="bevanda" value="Acqua" required> Acqua<br>
            <br>

            <input type="submit" value="Prosegui">
        </form>
    </section>
    <footer>
        <p>&copy; 2024 Il mio Bar (So dove abiti comunque)</p>
    </footer>
</body>
</html>
