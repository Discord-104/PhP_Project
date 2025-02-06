<?php
    require_once("classes/Utente.php");

    session_start();

    // Percorso del file credenziali.csv
    $filePath = "files/credenziali.csv";

    // Caricamento degli utenti dal file CSV
    $utenti = Utente::caricaUtenti($filePath);

    $utenteCorrente = null;
    foreach ($utenti as $utente) {
        if ($utente->getUsername() === $_SESSION['username'] && $utente->getPassword() === $_SESSION['password']) {
            $utenteCorrente = $utente;
            break;
        }
    }

    if ($utenteCorrente === null) {
        echo "Utente non trovato.";
        exit();
    }

    // Funzione per calcolare la cifra di controllo usando il metodo di Luhn
    function calcolaCifraDiControlloLuhn($stringaNumerica)
    {
        $somma = 0;

        if (strlen($stringaNumerica) % 2 !== 0) {
            $stringaNumerica = '0' . $stringaNumerica;
        }

        for ($i = 1; $i <= strlen($stringaNumerica); $i++) {
            $cifraCorrente = intval(substr($stringaNumerica, $i - 1, 1));
            $daSommare = 0;

            if ($i % 2 === 0) {
                $cifraRaddoppiata = $cifraCorrente * 2;
                if ($cifraRaddoppiata >= 10) {
                    $daSommare = 1 + ($cifraRaddoppiata % 10);
                } else {
                    $daSommare = $cifraRaddoppiata;
                }
            } else {
                $daSommare = $cifraCorrente;
            }

            $somma += $daSommare;
        }

        if ($somma % 10 === 0) {
            return 0;
        } else {
            return 10 - ($somma % 10);
        }
    }

    if (isset($_POST['numero_carta'], $_POST['cvv'], $_POST['scadenza'])) {
        $numeroCarta = $_POST['numero_carta'];
        $cvv = $_POST['cvv'];
        $scadenza = $_POST['scadenza'];

        // Validazione lato server
        $errori = [];

        if (empty($numeroCarta) || !preg_match('/^\d+$/', $numeroCarta) || strlen($numeroCarta) !== 16) {
            $errori[] = "Il numero di carta deve contenere esattamente 16 cifre.";
        } elseif (calcolaCifraDiControlloLuhn($numeroCarta) !== 0) {
            $errori[] = "Il numero di carta non è valido.";
        }

        if (empty($cvv) || !preg_match('/^\d+$/', $cvv) || strlen($cvv) !== 3) {
            $errori[] = "Il CVV deve contenere esattamente 3 cifre.";
        }

        if (empty($scadenza)) {
            $errori[] = "La data di scadenza è obbligatoria.";
        } else {
            $oggi = new DateTime();
            $dataScadenza = DateTime::createFromFormat('Y-m', $scadenza);
            if (!$dataScadenza || $dataScadenza < $oggi) {
                $errori[] = "La data di scadenza deve essere futura.";
            }
        }

        if (empty($errori)) {
            echo "Pagamento effettuato con successo!";
            exit();
        }
    }
?>

<!DOCTYPE html>
<html lang="it">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pagamento</title>
    <script src="JS/pagamento.js"></script>
</head>

<body>
    <style>
        /* Stile generale della pagina */
        * {
            box-sizing: border-box;
        }

        body {
            font-family: 'Arial', sans-serif;
            background-color: #000000;
            color: #ffffff;
            margin: 0;
            padding: 20px;
            display: flex;
            flex-direction: column;
            align-items: center;
            min-height: 100vh;
        }

        /* Titolo della pagina */
        h1 {
            color: #87CEEB;
            font-size: 2em;
            text-align: center;
            margin-bottom: 30px;
        }

        /* Sezione con i dati dell'utente */
        fieldset {
            background-color: rgba(255, 255, 255, 0.1);
            padding: 20px;
            border-radius: 10px;
            width: 100%;
            max-width: 800px;
            margin-bottom: 20px;
            box-shadow: 0 0 10px rgba(135, 206, 235, 0.5);
            border: 1px solid #87CEEB;
            overflow: hidden;
            /* Impedisce il trabocco dei contenuti */
        }

        legend {
            color: #87CEEB;
            font-size: 1.2em;
            font-weight: bold;
        }

        p {
            font-size: 1.1em;
            margin: 10px 0;
        }

        /* Form per i dati della carta di credito */
        form {
            background-color: rgba(255, 255, 255, 0.1);
            padding: 20px;
            border-radius: 10px;
            width: 100%;
            max-width: 800px;
            margin-top: 30px;
            box-shadow: 0 0 10px rgba(135, 206, 235, 0.5);
            border: 1px solid #87CEEB;
            overflow: hidden;
            /* Impedisce il trabocco dei contenuti */
        }

        /* Etichetta e input del form */
        label {
            color: #87CEEB;
            font-size: 1.1em;
            margin-bottom: 8px;
            display: block;
        }

        input[type="text"] {
            width: 100%;
            padding: 12px;
            border: 2px solid #87CEEB;
            border-radius: 5px;
            background-color: #000000;
            color: white;
            font-size: 1em;
            margin-bottom: 15px;
        }

        input[type="text"]:focus {
            outline: none;
            border-color: #ffffff;
            box-shadow: 0 0 5px rgba(135, 206, 235, 0.5);
        }

        /* Messaggi di errore */
        ul {
            color: red;
            font-size: 1.1em;
            margin-bottom: 20px;
            padding-left: 20px;
        }

        ul li {
            margin-bottom: 10px;
        }

        /* Bottone di invio */
        button {
            background-color: #87CEEB;
            color: #000000;
            border: none;
            padding: 15px 30px;
            border-radius: 5px;
            cursor: pointer;
            font-weight: bold;
            font-size: 1.1em;
            margin-top: 20px;
            transition: all 0.3s ease;
        }

        button:hover {
            background-color: #ffffff;
            transform: scale(1.05);
        }

        /* Responsività */
        @media (max-width: 600px) {
            fieldset {
                padding: 15px;
            }

            form {
                padding: 15px;
            }

            button {
                width: 100%;
            }
        }
    </style>

    <h1>Pagamento</h1>
    <?php
    if (!empty($errori)) {
        echo '<ul style="color: red;">';
        foreach ($errori as $errore) {
            echo "<li>$errore</li>";
        }
        echo '</ul>';
    }
    ?>
    <form method="POST" action="Riepilogo.php" onsubmit="return validaForm()">
        <fieldset>
            <legend>Dati Utente</legend>
            <p><strong>Nome:</strong> <?php echo $utenteCorrente->getNome(); ?></p>
            <p><strong>Cognome:</strong> <?php echo $utenteCorrente->getCognome(); ?></p>
            <p><strong>Indirizzo:</strong> <?php echo $utenteCorrente->getIndirizzo(); ?></p>
            <p><strong>Mail:</strong> <?php echo $utenteCorrente->getMail(); ?></p>
            <p><strong>CAP:</strong> <?php echo $utenteCorrente->getCAP(); ?></p>
        </fieldset>

        <fieldset>
            <legend>Dati Carta</legend>
            <label for="numero_carta">Numero Carta:</label>
            <input type="text" id="numero_carta" name="numero_carta" maxlength="16" required><br>

            <label for="cvv">CVV:</label>
            <input type="text" id="cvv" name="cvv" maxlength="3" required><br>

            <label for="scadenza">Scadenza (MM/YY):</label>
            <input type="month" id="scadenza" name="scadenza" required>
        </fieldset>

        <button type="submit" name="paga">Paga</button>
    </form>
</body>

</html>