<?php
require_once("classes/Prodotto.php");

if (!isset($_SESSION))
    session_start();

// Verifica se l'utente è autenticato
if (!isset($_SESSION['autenticato'])) {
    header('Location: login.php');
    exit();
}

// Recupero dell'ID prodotto passato tramite GET
if (!isset($_GET['IDprodotto'])) {
    echo "ID prodotto non fornito.";
    exit();
}

$IDprodotto = $_GET['IDprodotto'];

// Carica tutti i prodotti dal file CSV
$prodotti = Prodotto::caricaProdotti("prodotti/datas/prodotti.csv");

// Cerca il prodotto corrispondente all'ID fornito
$prodottoSelezionato = null;
foreach ($prodotti as $prodotto) {
    if ($prodotto->getIDprodotto() == $IDprodotto) {
        $prodottoSelezionato = $prodotto;
        break;
    }
}

if ($prodottoSelezionato === null) {
    echo "Prodotto non trovato.";
    exit();
}
?>

<!DOCTYPE html>
<html lang="it">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dettagli Prodotto</title>
</head>

<body>
    <style>
        /* Stile generale della pagina */
        body {
            font-family: 'Arial', sans-serif;
            background-color: #000000;
            color: #ffffff;
            margin: 0;
            padding: 20px;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        /* Header e titoli */
        h1,
        h2 {
            color: #87CEEB;
            margin-bottom: 20px;
            font-size: 2em;
            text-align: center;
        }

        /* Contenitore dei dettagli del prodotto */
        div {
            background-color: rgba(255, 255, 255, 0.1);
            padding: 30px;
            border-radius: 10px;
            width: 100%;
            max-width: 800px;
            margin-bottom: 20px;
            box-shadow: 0 0 10px rgba(135, 206, 235, 0.5);
            border: 1px solid #87CEEB;
            text-align: center;
        }

        /* Immagine del prodotto */
        img {
            max-width: 100%;
            max-height: 300px;
            margin-bottom: 20px;
            border-radius: 10px;
        }

        /* Form per aggiungere al carrello */
        form {
            background-color: rgba(255, 255, 255, 0.1);
            padding: 20px;
            border-radius: 10px;
            display: inline-block;
            width: 100%;
            max-width: 400px;
            margin-top: 20px;
            border: 1px solid #87CEEB;
        }

        /* Etichetta e input del form */
        label {
            color: #87CEEB;
            font-size: 1em;
            margin-bottom: 5px;
            display: block;
        }

        /* Select per la quantità */
        select,
        input[type="number"] {
            width: 100%;
            padding: 12px;
            border: 2px solid #87CEEB;
            border-radius: 5px;
            background-color: #000000;
            color: white;
            font-size: 1em;
            box-sizing: border-box;
            margin-bottom: 15px;
        }

        select:focus,
        input[type="number"]:focus {
            outline: none;
            border-color: #ffffff;
            box-shadow: 0 0 5px rgba(135, 206, 235, 0.5);
        }

        /* Button styling */
        button {
            background-color: #87CEEB;
            color: #000000;
            border: none;
            padding: 15px 30px;
            border-radius: 5px;
            cursor: pointer;
            font-weight: bold;
            font-size: 1.1em;
            margin-top: 15px;
            transition: all 0.3s ease;
        }

        button:hover {
            background-color: #ffffff;
            transform: scale(1.05);
        }

        /* Link */
        a {
            display: inline-block;
            color: #87CEEB;
            text-decoration: none;
            font-weight: bold;
            margin-top: 30px;
            padding: 10px 15px;
            border: 1px solid #87CEEB;
            border-radius: 5px;
            transition: all 0.3s ease;
            background-color: rgba(255, 255, 255, 0.1);
        }

        a:hover {
            color: #000000;
            background-color: #87CEEB;
            text-decoration: underline;
        }

        /* Responsività */
        @media (max-width: 600px) {
            div {
                padding: 20px;
            }

            form {
                padding: 15px;
            }

            button {
                width: 100%;
            }

            a {
                width: 100%;
                margin-top: 20px;
            }
        }
    </style>
    <h1>Dettagli Prodotto</h1>

    <div style="max-width: 50%;">

    <?php
    
    $newPath = ltrim($prodottoSelezionato->getPathImmagine(),".");
    
    ?>


        <img src="<?php echo ".".$newPath; ?>"
            alt="<?php echo $prodottoSelezionato->getNome(); ?>" style="max-width: 100%; max-height: 100%;">
        <h2><?php echo $prodottoSelezionato->getNome(); ?></h2>
        <p><strong>Descrizione:</strong> <?php echo $prodottoSelezionato->getDescrizione(); ?></p>
        <p><strong>Quantità disponibile:</strong> <?php echo $prodottoSelezionato->getQuantita(); ?></p>
        <p><strong>Fornitore:</strong> <?php echo $prodottoSelezionato->getFornitore(); ?></p>
        <p><strong>Tipologia:</strong> <?php echo $prodottoSelezionato->getTipo(); ?></p>


        <?php if (!hash_equals($_SESSION["username"], "admin")) { ?>
            <form action="aggiungiCarrello.php" method="POST">
                <label for="quantita">Quantità:</label>
                <select name="quantita" id="quantita">
                    <?php
                    // Genera opzioni del menu a tendina in base alla quantità disponibile
                    for ($i = 1; $i <= $prodottoSelezionato->getQuantita(); $i++) {
                        echo "<option value='$i'>$i</option>";
                    }
                    ?>
                </select>
                <input type="hidden" name="IDprodotto" value="<?php echo $prodottoSelezionato->getIDprodotto(); ?>">
                <button type="submit">Aggiungi al Carrello</button>
            </form>
        <?php } else { ?>



            <form action="modificaQuantita.php" method="POST">
                <h4>Se si inserisce un numero negativo, la quantità diminuirà, e se va a 0 il prodotto verrà eliminato.
                    Invece, inserendo un numero positivo la quantità aumenterà.
                </h4>

                <label for="modifica">Modifica quantità</label>
                <input type="number" name="qMod">

                <input type="hidden" name="IDprodotto" value="<?php echo $prodottoSelezionato->getIDprodotto(); ?>">
                <button type="submit">Modifica quantità</button>
            </form>



        <?php } ?>


    </div>

    <?php

    echo "<a href='pagineUtenti/". $_SESSION["username"] .".php'>Torna alla Home Page</a>";
             
    
    ?>
</body>

</html>