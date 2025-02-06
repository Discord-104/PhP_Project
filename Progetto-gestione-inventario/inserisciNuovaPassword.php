<?php

if (!isset($_SESSION))
    session_start();

if (isset($_POST["password"]) && isset($_POST["conferma"])) {

    if (hash_equals($_POST["password"], $_POST["conferma"])) {
        //effettuo la modifica della password
        $credenzialiDiTutti = file_get_contents("./files/credenziali.csv");

        $righe = explode("\r\n", $credenzialiDiTutti);

        foreach ($righe as $riga) {
            $campi = explode(";", $riga);

            if (hash_equals($_SESSION["mail"], $campi[5])) {
                $campi[1] = $_POST["password"];
                $nuovaRiga = $campi[0] . ";" . $campi[1] . ";" . $campi[2] . ";" . $campi[3] . ";" . $campi[4] . ";" . $campi[5] . ";" . $campi[6] . ";" . $campi[7];
                $credenzialiAggiornate[] = $nuovaRiga;
            } else {
                $credenzialiAggiornate[] = $riga;
            }

        }

        // Elimina il vecchio file
        $filePath = "./files/credenziali.csv";
        if (file_exists($filePath)) {
            unlink($filePath);
        }

        // Crea un nuovo file e scrive le credenziali aggiornate
        $nuovoContenuto = implode("\r\n", $credenzialiAggiornate);
        file_put_contents($filePath, $nuovoContenuto);

        header("location: login.php?messaggio=Password aggiornata con successo! ");
    } else {
        echo "Le password non corrispondono!";
        unset($_POST["password"]);
        unset($_POST["conferma"]);
    }
}

?>

<!DOCTYPE html>
<html lang="it">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
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
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }

        /* Stile per il form */
        form {
            background-color: rgba(255, 255, 255, 0.1);
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.5);
            width: 100%;
            max-width: 400px;
            text-align: center;
        }

        /* Container per ogni gruppo di input */
        .input-group {
            margin: 15px 0;
            text-align: left;
        }

        /* Label per i campi password */
        .input-group label {
            color: #87CEEB;
            display: block;
            margin-bottom: 8px;
            font-size: 1em;
        }

        /* Stile per gli input password */
        input[type="password"] {
            width: 100%;
            padding: 12px;
            margin: 5px 0;
            border: 2px solid #87CEEB;
            border-radius: 5px;
            background-color: #000000;
            color: white;
            font-size: 1em;
            box-sizing: border-box;
        }

        input[type="password"]:focus {
            outline: none;
            border-color: #ffffff;
            box-shadow: 0 0 5px rgba(135, 206, 235, 0.5);
        }

        /* Stile per il pulsante */
        button {
            background-color: #87CEEB;
            color: #000000;
            border: none;
            padding: 12px 25px;
            margin-top: 20px;
            font-size: 1em;
            cursor: pointer;
            border-radius: 5px;
            font-weight: bold;
            transition: all 0.3s ease;
        }

        button:hover {
            background-color: #ffffff;
            transform: scale(1.05);
        }

        /* Stile per i messaggi di errore */
        .error-message {
            color: #ff4444;
            text-align: center;
            padding: 10px;
            margin: 10px 0;
            background-color: rgba(255, 68, 68, 0.1);
            border-radius: 5px;
        }
    </style>
    <form action="" method="POST">
        Inserisci la password <input type="password" name="password" required><br><br>
        Conferma la password <input type="password" name="conferma" required><br><br>
        <button>INVIA</button>
    </form>
</body>

</html>