<?php
    require_once("classi/Ordine.php");
    session_start();
    
    if (!isset($_SESSION['ordine'])) {
        header("Location: index.php?messaggio=Devi prima completare il processo");
        exit();
    }

    if (isset($_GET['bevanda'])) {
        $_SESSION['ordine']->setBevanda($_GET['bevanda']);
    }

    $ordine = $_SESSION['ordine'];
?>

<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riepilogo delle tue scelte</title>
    <link rel="stylesheet" href="CSS/style.css">
</head>
<body>
    <header>
        <h1>Ecco quello ordinato e spero per te che stasera tu riesca a dormire con un occhio aperto</h1>
    </header>
    <section>
        <h1>Riepilogo delle tue scelte</h1>
        <p><strong>Nome:</strong> <?php echo $ordine->getNome(); ?></p>
        <p><strong>Cognome:</strong> <?php echo $ordine->getCognome(); ?></p>
        <p><strong>Classe:</strong> <?php echo $ordine->getClasse(); ?></p>
        <p><strong>Cibo scelto:</strong> <?php echo $ordine->getPasto(); ?></p>
        <p><strong>Bevanda scelta:</strong> <?php echo $ordine->getBevanda(); ?></p>

        <a href="index.php">Torna all'inizio</a>
    </section>
    <footer>
        <p>&copy; 2024 Il mio Bar (Consiglio: non urlare di notte che svegli i vicini quindi fatti rapire senza fare storie)</p>
    </footer>
</body>
</html>
