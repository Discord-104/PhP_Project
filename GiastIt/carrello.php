<?php
    require_once("classi/Ordine.php");
    session_start();

    // Inizializza il carrello se non esiste già
    if (!isset($_SESSION['ordine'])) {
        $_SESSION['ordine'] = new Ordine();
    }

    // Controlla se sono stati inviati i dati del prodotto
    if (isset($_GET['prodotto']) && isset($_GET['prezzo'])) {
        $prodotto = $_GET['prodotto'];
        $prezzo = $_GET['prezzo'];
        
        // Aggiungi il prodotto all'ordine
        $_SESSION['ordine']->aggiungiProdotto($prodotto, $prezzo);
    }

    // Controlla se si desidera svuotare il carrello
    if (isset($_GET['svuota'])) {
        unset($_SESSION['ordine']);
        header("Location: carrello.php");
        exit();
    }

    // Ottieni i prodotti e il totale dall'ordine
    $prodotti = $_SESSION['ordine']->getProdotti();
    $totale = $_SESSION['ordine']->getTotale();
?>

<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carrello - GiastIt</title>
    <link rel="stylesheet" href="CSS/carrello.css">
</head>
<body>
    <header>
        <h1>Carrello</h1>
    </header>
    <main>
        <h2>Prodotti nel Carrello</h2>
        <ul>
            <?php
            if (count($prodotti) > 0) {
                foreach ($prodotti as $articolo) {
                    echo '<li>' . $articolo['prodotto'] . ' - €' . $articolo['prezzo'] . '</li>';
                }
            } else {
                echo '<li>Il carrello è vuoto.</li>';
            }
            ?>
        </ul>
        <h3>Totale: €<?php echo $totale; ?></h3>
        <a href="paginaOrdine.php">Procedi al pagamento</a>
        <br>
        <a href="paginaPrivata.php" class="button">Torna al Menu</a>
        <a href="carrello.php?svuota=true" class="button">Svuota il Carrello</a>
    </main>
    <footer>
        <p>
            <img src="IMG/Logo.jpeg" alt="Logo" class="logo-copyright">
            &copy; 2024 GiastIt. Tutti i diritti riservati.
        </p>
    </footer>
</body>
</html>
