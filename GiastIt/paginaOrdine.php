<?php
    require_once("classi/Ordine.php");
    session_start();

    // Controlla se l'ordine esiste nella sessione
    if (!isset($_SESSION['ordine'])) {
        header("Location: carrello.php");
        exit();
    }

    $ordine = $_SESSION['ordine'];
    $prodotti = $ordine->getProdotti();
    $totale = $ordine->getTotale();
    $sconto = 0;

    // Applica sconto per utente PRO
    if (isset($_SESSION["tipo_utente"]) && $_SESSION["tipo_utente"] === "pro") {
        $sconto = $totale * 0.2; // Sconto del 20%
    }

    $totaleConSconto = $totale - $sconto;

    // Gestione logout
    if (isset($_GET['logout'])) {
        // Cancella l'ordine
        unset($_SESSION['ordine']);
        // Logout dell'utente
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
    <title>Pagamento - GiastIt</title>
    <link rel="stylesheet" href="CSS/ordine.css">
    <script src="JS/script.js"></script>
</head>
<body>
    <header>
        <h1>Riepilogo Pagamento</h1>
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

        <div class="form-container">
            <h2>Dettagli di Pagamento</h2>
            <form action="finalizzaOrdine.php" method="get">
                <input type="text" name="nome" placeholder="Nome" required>
                <input type="text" name="cognome" placeholder="Cognome" required>
                <input type="text" name="via" placeholder="Via" required>
                <input type="date" name="orario" placeholder="Orario di Consegna" required>
                
                <select name="metodo" id="metodoPagamento" style="display:block;" required>
                    <option value="" disabled selected>Metodo di Pagamento</option>
                    <option value="contanti">Contanti</option>
                    <option value="carta">Carta</option>
                </select>

                <div id="datiCartaContainer">
                    
                </div>

                <button type="submit">Procedi al Pagamento</button>
            </form>
        </div>
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