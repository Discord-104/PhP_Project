<?php
require_once("classes/Prodotto.php");

if (!isset($_SESSION))
    session_start();

// Verifica se l'utente è autenticato
if (!isset($_SESSION['autenticato'])) {
    header('Location: login.php');
    exit();
}

// Recupero del nome utente dalla sessione
$username = $_SESSION['username'];


// Funzione per caricare i prodotti dal file CSV
$prodotti = Prodotto::caricaProdotti("../prodotti/datas/prodotti.csv");

// Gestione della ricerca
$searchTerm = '';
if (isset($_POST['search'])) {
    $searchTerm = $_POST['search'];
    $prodotti = Prodotto::cercaProdotti($prodotti, $searchTerm);
}

// Gestione del filtro per tipo di prodotto
$tipoSelezionato = '';
if (isset($_POST['filtra'])) {
    $tipoSelezionato = $_POST['tipo'];
    $prodottiFiltrati = [];  // Array per i prodotti filtrati

    foreach ($prodotti as $prodotto) {
        // Verifica se il tipo del prodotto corrisponde al tipo selezionato
        if ($prodotto->getTipo() === $tipoSelezionato) {
            $prodottiFiltrati[] = $prodotto;  // Aggiungi il prodotto filtrato all'array
        }
    }

    $prodotti = $prodottiFiltrati;  // Aggiorna l'array di prodotti con quelli filtrati
}

// Ordinamento
if (isset($_POST['sort'])) {
    $prodotti = Prodotto::ordinaProdotti($prodotti);
}

if (isset($_POST["add"])) {
    header("location: ../addNuovoProdotto.php");
    exit;
}

// Elimina filtri
if (isset($_POST['reset'])) {
    $searchTerm = '';
    $tipoSelezionato = '';
    $prodotti = Prodotto::caricaProdotti("../prodotti/datas/prodotti.csv");
}

// Recupera i tipi unici di prodotto
$tipiProdotto = Prodotto::ottieniTipiUnici($prodotti);
?>

<!DOCTYPE html>
<html lang="it">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Page</title>
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
            min-height: 100vh;
        }

        /* Header e titoli */
        h1 {
            color: #87CEEB;
            margin-bottom: 30px;
            font-size: 2em;
        }

        h2 {
            color: #ffffff;
            margin-bottom: 20px;
        }

        /* Contenitore dei controlli */
        .controls-container {
            display: flex;
            flex-wrap: wrap;
            gap: 15px;
            margin-bottom: 30px;
            padding: 20px;
            background-color: rgba(255, 255, 255, 0.1);
            border-radius: 10px;
        }

        /* Stile per i form */
        form {
            margin: 10px;
            display: inline-flex;
            gap: 10px;
            align-items: center;
        }

        /* Stile per gli input */
        input[type="text"],
        select {
            padding: 10px;
            border: 2px solid #87CEEB;
            border-radius: 5px;
            background-color: #000000;
            color: white;
            font-size: 1em;
        }

        input[type="text"]:focus,
        select:focus {
            outline: none;
            border-color: #ffffff;
            box-shadow: 0 0 5px rgba(135, 206, 235, 0.5);
        }

        /* Stile per i pulsanti */
        button {
            background-color: #87CEEB;
            color: #000000;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            font-weight: bold;
            transition: all 0.3s ease;
        }

        button:hover {
            background-color: #ffffff;
            transform: scale(1.05);
        }

        /* Layout dei prodotti */
        .products-container {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
        }

        /* Card del prodotto */
        .product-card {
            background-color: rgba(255, 255, 255, 0.1);
            border-radius: 10px;
            padding: 20px;
            width: 200px;
            /* Larghezza fissa per ogni card */
            margin-bottom: 20px;
            transition: transform 0.3s ease;
        }

        .product-card:hover {
            transform: translateY(-5px);
        }

        /* Immagine del prodotto */
        .product-image {
            width: 100%;
            height: 150px;
            object-fit: cover;
            border-radius: 5px;
            margin-bottom: 15px;
        }

        /* Dettagli del prodotto */
        .product-title {
            color: #87CEEB;
            margin: 10px 0;
            font-size: 1.2em;
        }

        .product-description {
            color: #cccccc;
            margin: 10px 0;
            font-size: 0.9em;
        }

        .product-price {
            color: #ffffff;
            font-weight: bold;
            margin: 10px 0;
            font-size: 1.1em;
        }

        .product-quantity {
            color: #87CEEB;
            margin: 10px 0;
        }

        /* Messaggio nessun prodotto */
        .no-products {
            text-align: center;
            color: #87CEEB;
            padding: 20px;
            font-size: 1.2em;
            width: 100%;
        }
    </style>
    <h1>Benvenuto, <?php echo $username; ?>!</h1>

    <h2>Prodotti disponibili</h2>

    <!-- Form per ricerca -->
    <form method="POST">
        <input type="text" name="search" placeholder="Cerca un prodotto" value="<?php echo $searchTerm; ?>">
        <button type="submit">Cerca</button>
        <button type="submit" name="sort">Ordina per nome</button>
        <button type="submit" name="add">Aggiungi nuovo prodotto</button>
    </form>


    <!-- Form per filtro per tipo di prodotto -->
    <form method="POST">
        <select name="tipo">
            <option value="">Seleziona tipo</option>
            <?php
            foreach ($tipiProdotto as $tipo) {
                if ($tipo == $tipoSelezionato) {
                    echo "<option value='$tipo' selected>$tipo</option>";
                } else {
                    echo "<option value='$tipo'>$tipo</option>";
                }
            }
            ?>
        </select>
        <button type="submit" name="filtra">Filtra</button>
    </form>

    <!-- Form per andare al carrello -->
    <form action="../carrello.php" method="GET">
        <button type="submit">Vai al Carrello</button>
    </form>

    <form method="POST">
        <button type="submit" name="reset">Elimina filtri</button>
    </form>

    <div>
        <?php
        if (!empty($prodotti)) {
            foreach ($prodotti as $prodotto) {
                if ($prodotto->getIDProdotto() != 0) {
                    ?>
                    <div style="max-width: 20%;">
                        <img src="<?php echo $prodotto->getPathImmagine(); ?>" alt="<?php echo $prodotto->getNome(); ?>"
                            style="max-width: 50%; max-height: 50%;">
                        <h3><?php echo $prodotto->getNome(); ?></h3>
                        <p><?php echo $prodotto->getDescrizione(); ?></p>
                        <p>Prezzo: <?php echo number_format($prodotto->getPrezzo(), 2)?></p>
                        <p>Quantità: <?php echo $prodotto->getQuantita(); ?></p>
                        <form action="../DettagliProdotto.php" method="GET">
                            <input type="hidden" name="IDprodotto" value="<?php echo $prodotto->getIDProdotto(); ?>">
                            <button type="submit">Dettagli</button>
                        </form>
                    </div>
                    <?php
                }
            }
        } else {
            ?>
            <p>Nessun prodotto trovato.</p>
            <?php
        }
        ?>
    </div>
</body>

</html>