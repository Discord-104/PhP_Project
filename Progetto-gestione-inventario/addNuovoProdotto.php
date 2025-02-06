<?php
require_once("./classes/Prodotto.php");

if (!isset($_SESSION))
    session_start();

if (!isset($_SESSION["autenticato"]) || $_SESSION["autenticato"] != "A") {
    header("Location: index.php?messaggio=Non hai i permessi per accedere a questa pagina");
    exit;
}

//mi assicuro che ci sia tutto
if (count($_POST) == 5 && count($_FILES) == 1) {
    //aggiungo il prodotto al CSV   
    //prendo il contenuto del file prodotti
    $contenuto = file_get_contents("./prodotti/datas/prodotti.csv");

    //lo splitto in righe
    $righe = explode("\r\n", $contenuto);

    foreach ($righe as $riga) {
        //lavoro sui singoli campi
        $idAttuale = 0;
        $campi = explode(";", $riga);
        $id = (int) $campi[0];
        $idAttuale += $id;
    }

    //devo processare l'immagine e ricavarne il path

    $temp = $_FILES["immagine"]["tmp_name"];
    $nuovoNome = "./prodotti/images/" . $_FILES["immagine"]["name"];

    move_uploaded_file($temp, $nuovoNome);

    $newIDProdotto = $idAttuale + 1;
    $nomeProdotto = $_POST["Nome"];
    $descrizioneProdotto = $_POST["Descrizione"];
    $fornitoreProdotto = $_POST["Fornitore"];
    $prezzoProdotto = $_POST["Prezzo"];
    $tipologiaProdotto = $_POST["Tipologia"];

    $newProdotto = new Prodotto(
        $newIDProdotto,
        $nomeProdotto,
        $descrizioneProdotto,
        $fornitoreProdotto,
        $prezzoProdotto,
        "." . $nuovoNome,
        $tipologiaProdotto
    );

    print_r($_SESSION);



    $newProdotto->salvaSuFile("./prodotti/datas/prodotti.csv");

    header("location: ./pagineUtenti/" . $_SESSION["username"] . ".php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aggiungi prodotto nuovo</title>
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

        /* Titolo della pagina */
        h1 {
            color: #87CEEB;
            font-size: 2.5em;
            margin-bottom: 30px;
            text-align: center;
        }

        /* Form container */
        form {
            background-color: rgba(255, 255, 255, 0.1);
            padding: 30px;
            border-radius: 10px;
            width: 100%;
            max-width: 600px;
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        /* Label styling */
        label {
            color: #87CEEB;
            font-size: 1.1em;
            margin-bottom: 8px;
            display: block;
        }

        /* Input fields */
        input[type="text"],
        input[type="number"],
        input[type="file"],
        textarea,
        select {
            width: 100%;
            padding: 12px;
            border: 2px solid #87CEEB;
            border-radius: 5px;
            background-color: #000000;
            color: white;
            font-size: 1.1em;
            box-sizing: border-box;
        }

        /* Area di testo per la descrizione */
        textarea {
            resize: vertical;
            min-height: 150px;
        }

        /* Focus sugli input */
        input:focus,
        textarea:focus,
        select:focus {
            outline: none;
            border-color: #ffffff;
            box-shadow: 0 0 5px rgba(135, 206, 235, 0.5);
        }

        /* Select styling */
        select {
            cursor: pointer;
        }

        select option {
            background-color: #000000;
            color: white;
        }

        /* Stile per il pulsante */
        button {
            background-color: #87CEEB;
            color: #000000;
            border: none;
            padding: 15px 30px;
            border-radius: 5px;
            cursor: pointer;
            font-weight: bold;
            font-size: 1.2em;
            margin-top: 20px;
            transition: all 0.3s ease;
        }

        button:hover {
            background-color: #ffffff;
            transform: scale(1.05);
        }

        /* Stile per il messaggio di errore */
        p[style*="color: red"] {
            background-color: rgba(255, 0, 0, 0.1);
            padding: 10px;
            border-radius: 5px;
            border-left: 4px solid red;
            margin: 10px 0;
        }

        /* Stile per il messaggio di successo */
        p[style*="color: green"] {
            background-color: rgba(0, 255, 0, 0.1);
            padding: 10px;
            border-radius: 5px;
            border-left: 4px solid green;
            margin: 10px 0;
        }

        /* Link styling */
        a {
            color: #87CEEB;
            text-decoration: none;
            transition: color 0.3s ease;
        }

        a:hover {
            color: #ffffff;
            text-decoration: underline;
        }

        /* Placeholder styling */
        ::placeholder {
            color: rgba(255, 255, 255, 0.5);
        }

        /* Responsive adjustments */
        @media (max-width: 600px) {
            form {
                padding: 20px;
            }

            button {
                width: 100%;
            }
        }
    </style>
    <form method="POST" enctype="multipart/form-data">

        Immagine prodotto: <input type="file" name="immagine" required>
        <br><br>

        Nome prodottto: <input type="text" name="Nome" required>
        <br><br>

        Descrizione prodotto: <br><textarea name="Descrizione"
            style="max-height: 250px; max-width: 400px; min-height: 250px; min-width: 400px;" required></textarea>
        <br><br>

        Fornitore: <input type="text" name="Fornitore" required>
        <br><br>

        Prezzo: <input type="number" step="0.01" name="Prezzo" required>
        <br><br>
        Tipologia prodotto: <input type="text" name="Tipologia" required>
        <br><br>
        <button>CREA</button>

    </form>

</body>

</html>