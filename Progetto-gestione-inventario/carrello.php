<?php
if (!isset($_SESSION))
    session_start();

if (!isset($_SESSION['homePageLink'])) {
    $_SESSION['homePageLink'] = "HomePage.php";
}

// Gestione del pulsante "Pulisci Carrello"
if (isset($_POST['pulisci'])) {
    unset($_SESSION['carrello']); // Svuota solo il carrello
    header("Location: carrello.php"); // Ricarica la pagina
    exit();
}

// Gestione della cancellazione della quantità di un singolo prodotto
if (isset($_POST['elimina'])) {
    $indexToDelete = $_POST['index'];
    $quantitaToDelete = $_POST['quantita']; // Quantità da eliminare

    // Verifica che la quantità da eliminare non sia maggiore di quella presente
    if ($quantitaToDelete > $_SESSION['carrello'][$indexToDelete]['quantita']) {
        echo "La quantità da eliminare non può essere maggiore di quella presente nel carrello.";
        exit();
    }

    // Sottrarre la quantità dal carrello
    $_SESSION['carrello'][$indexToDelete]['quantita'] -= $quantitaToDelete;

    // Se la quantità diventa 0, rimuovi completamente l'elemento dal carrello
    if ($_SESSION['carrello'][$indexToDelete]['quantita'] == 0) {
        unset($_SESSION['carrello'][$indexToDelete]);
    }

    // Riorganizza gli indici dell'array
    $_SESSION['carrello'] = array_values($_SESSION['carrello']);

    header("Location: carrello.php"); // Ricarica la pagina
    exit();
}

// Debug: Controllo del contenuto del carrello
echo "<pre>";
//print_r($_SESSION['carrello']);
echo "</pre>";


?>

<!DOCTYPE html>
<html lang="it">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carrello</title>

    <style>
        /* Stile generale della pagina */
        body {
            font-family: 'Arial', sans-serif;
            background-color: #121212;
            color: #ffffff;
            margin: 0;
            padding: 20px;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        /* Titolo della pagina */
        h1 {
            color: #87CEEB;
            font-size: 2em;
            margin-bottom: 30px;
        }

        /* Tabella del carrello */
        table {
            width: 100%;
            max-width: 900px;
            border-collapse: collapse;
            margin-bottom: 20px;
            background-color: #1a1a1a;
        }

        th,
        td {
            padding: 10px;
            text-align: center;
            border: 1px solid #87CEEB;
        }

        th {
            background-color: #333333;
        }

        td {
            background-color: #222222;
        }

        /* Colonne di intestazione */
        th {
            color: #87CEEB;
        }

        /* Colonne dei prodotti */
        td {
            color: #ffffff;
        }

        /* Pulsanti */
        button {
            background-color: #87CEEB;
            color: #000000;
            border: none;
            padding: 12px 20px;
            border-radius: 5px;
            cursor: pointer;
            font-weight: bold;
            font-size: 1em;
            transition: all 0.3s ease;
            margin: 10px;
        }

        button:hover {
            background-color: #ffffff;
            transform: scale(1.05);
        }

        form {
            display: inline-block;
        }

        /* Form di selezione quantità */
        select {
            padding: 5px;
            font-size: 1em;
            border-radius: 5px;
            border: 1px solid #87CEEB;
            background-color: #333333;
            color: #ffffff;
        }

        /* Messaggi di errore o avviso */
        .error {
            color: red;
            font-size: 1.1em;
            margin-bottom: 20px;
        }

        /* Link alla home page */
        a {
            color: #87CEEB;
            text-decoration: none;
            font-size: 1.1em;
        }

        a:hover {
            text-decoration: underline;
        }

        /* Responsività per dispositivi mobili */
        @media (max-width: 600px) {
            table {
                width: 100%;
            }

            button {
                width: 100%;
            }
        }
    </style>

</head>

<body>

    <h1>Carrello</h1>

    <table>
        <tr>
            <th>Prodotto</th>
            <th>Quantità</th>
            <th>Prezzo</th>
            <th>Totale</th>
            <th>Azioni</th>
        </tr>

        <?php

        if (!isset($_SESSION['carrello']) || count($_SESSION['carrello']) === 0) {
            echo "Il carrello è vuoto.<br>";
            echo "<a href='pagineUtenti/" . $_SESSION["username"] . ".php'>Torna alla Home Page</a>";
            exit();
        } else {
            $totaleCarrello = 0;
            foreach ($_SESSION['carrello'] as $index => $item) {
                $totaleProdotto = $item['prezzo'] * $item['quantita'];
                $totaleCarrello += $totaleProdotto;
                echo "<tr>
                    <td>" . $item['nome'] . "</td>
                    <td>" . intval($item['quantita']) . "</td>
                    <td>" . number_format($item['prezzo'], 2, ',', '.') . " €</td>
                    <td>" . number_format($totaleProdotto, 2, ',', '.') . " €</td>
                    <td>
                        <form method='post' action=''>
                            <input type='hidden' name='index' value='$index'>
                            <select name='quantita'>"; // Menu a tendina per la quantità
                
                // Popola il menu a tendina con le quantità disponibili
                for ($i = 1; $i <= $item['quantita']; $i++) {
                    echo "<option value='$i'>$i</option>";
                }
            
                echo "</select>
                            <button type='submit' name='elimina'>Cancella</button>
                        </form>
                    </td>
                </tr>";
            }
        }
        echo "<tr>
            <td colspan='3'><strong>Totale Carrello:</strong></td>
            <td><strong>" . number_format($totaleCarrello, 2, ',', '.') . " €</strong></td>
        </tr>";
        ?>
    </table>

    <form method="POST" action="">
        <button type="submit" name="pulisci">Pulisci Carrello</button>
    </form>

    <form method="GET" action="PagamentoCarta.php">
        <button type="submit">Procedi al Pagamento</button>
    </form>

    <?php echo "<a href='pagineUtenti/" . $_SESSION["username"] . ".php'>Torna alla Home Page</a>"; ?>
</body>

</html>