<?php
    require_once("classi/Ordine.php");
    session_start();

    // Controlla se l'ordine esiste nella sessione
    if (!isset($_SESSION['ordine'])) {
        header("Location: carrello.php");
        exit();
    }

    // Recupera l'ordine e i dettagli di pagamento inviati
    $ordine = $_SESSION['ordine'];
    $prodotti = $ordine->getProdotti();
    $totale = $ordine->getTotale();
    $sconto = 0;

    // Applica sconto per utente PRO
    if (isset($_SESSION["tipo_utente"]) && $_SESSION["tipo_utente"] === "pro") {
        $sconto = $totale * 0.2; // Sconto del 20%
    }

    $totaleConSconto = $totale - $sconto;

    // Gestione dei dati inviati tramite il form
    $nome = '';
    if (isset($_GET['nome'])) {
        $nome = $_GET['nome'];
    }

    $cognome = '';
    if (isset($_GET['cognome'])) {
        $cognome = $_GET['cognome'];
    }

    $via = '';
    if (isset($_GET['via'])) {
        $via = $_GET['via'];
    }

    $orario = '';
    if (isset($_GET['orario'])) {
        $orario = $_GET['orario'];
    }

    $metodoPagamento = '';
    if (isset($_GET['metodo'])) {
        $metodoPagamento = $_GET['metodo'];
    }

    $codiceCarta = '';
    if (isset($_GET['codice'])) {
        $codiceCarta = $_GET['codice'];
    }

    $scadenza = '';
    if (isset($_GET['scadenza'])) {
        $scadenza = $_GET['scadenza'];
    }

    $cvv = '';
    if (isset($_GET['cvv'])) {
        $cvv = $_GET['cvv'];
    }

    // Gestione logout
    if (isset($_GET['logout'])) {
        unset($_SESSION['ordine']);
        session_destroy();
        header("Location: login.php");
        exit();
    }
?>

<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riepilogo Ordine - GiastIt</title>
    <link rel="stylesheet" href="CSS/Repilogo.css">
</head>
<body>
    <header>
        <h1>Riepilogo Ordine</h1>
    </header>
    <main>
        <h2>Prodotti nel Carrello</h2>
        <ul>
            <?php 
            foreach ($prodotti as $articolo) {
                echo "<li>" . $articolo['prodotto'] . " - €" . $articolo['prezzo'] . "</li>"; 
            } 
            ?>
        </ul>
        <h3>Totale: €<?php echo $totale; ?></h3>
        <h3>Sconto: - €<?php echo $sconto; ?></h3>
        <h3>Totale Finale: €<?php echo $totaleConSconto; ?></h3>

        <h2>Dettagli di Consegna</h2>
        <p>Nome: <?php echo $nome; ?></p>
        <p>Cognome: <?php echo $cognome; ?></p>
        <p>Via: <?php echo $via; ?></p>
        <p>Orario di Consegna: <?php echo $orario; ?></p>
        <p>Metodo di Pagamento: <?php echo $metodoPagamento; ?></p>
        
        <?php if ($metodoPagamento === 'carta') : ?>
            <p>Codice Carta: <?php echo $codiceCarta; ?></p>
            <p>Data Scadenza: <?php echo $scadenza; ?></p>
            <p>CVV: <?php echo $cvv; ?></p>
        <?php endif; ?>

        <a href="paginaPrivata.php"><button>Torna al Menu</button></a>
        <br>
        <a href="?logout=true"><button>Logout</button></a>
    </main>
    <footer>
        <p>
            <img src="IMG/Logo.jpeg" alt="Logo" class="logo-copyright">
            &copy; 2024 GiastIt. Tutti i diritti riservati.
        </p>
    </footer>
</body>
</html>