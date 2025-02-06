<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recupera password</title>
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

        /* Stile per i messaggi e testo */
        .message {
            color: #87CEEB;
            margin: 10px 0;
            font-size: 1.1em;
            text-align: center;
        }

        /* Stile per l'input del codice */
        input[type="number"] {
            width: 200px;
            padding: 12px;
            margin: 15px auto;
            border: 2px solid #87CEEB;
            border-radius: 5px;
            background-color: #000000;
            color: white;
            font-size: 1.2em;
            text-align: center;
            display: block;
        }

        /* Rimuove le frecce dall'input number */
        input[type="number"]::-webkit-inner-spin-button,
        input[type="number"]::-webkit-outer-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        input[type="number"] {
            -moz-appearance: textfield;
        }

        input[type="number"]:focus {
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

        /* Stile per messaggi di errore */
        .error {
            color: #ff4444;
            margin: 10px 0;
            text-align: center;
        }
    </style>
</body>

</html>

<?php

if (!isset($_SESSION))
    session_start();


if (isset($_SESSION["codiceGenerato"]) && isset($_POST["codiceInserito"])) {
    if ($_SESSION["codiceGenerato"] === $_POST["codiceInserito"]) {
        header("location: inserisciNuovaPassword.php");
        exit;
    } else {
        unset($_SESSION["codiceGenerato"]);
        unset($_POST["codiceInserito"]);
        echo "Codice inserito sbagliato, ne è stato inviato un altro";
    }

}

$mail = "";
if (isset($_POST["mail"])) {
    //controllo se la mail esiste nel csv, se si la assegno e vado avanti, altrimenti torno indietro

    $credenzialiDiTutti = file_get_contents("./files/credenziali.csv");

    $righe = explode("\r\n", $credenzialiDiTutti);

    foreach ($righe as $riga) {
        $campi = explode(";", $riga);
        if (count($campi) == 8)
            if (hash_equals($_POST["mail"], $campi[5]))
                $mail = $_POST["mail"];

    }
    if ($mail == "") {
        header("location: inputMail.php?messaggio=Mail non trovata");
        exit;
    }

}

$codice = "";
for ($i = 0; $i < 6; $i++) {
    $numeretto = random_int(0, 9);
    $codice = $codice . $numeretto;
}


/*Classe per la gestione delle eccezioni e degli errori*/
require './mailer/PHPMailer.php';
/*Classe PHPMailer*/
require './mailer/Exception.php';
/*Classe SMTP, necessaria per stabilire la connessione con un server SMTP*/
require './mailer/SMTP.php';


use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

//creo l'oggetto PHPmailer

/*Quando si crea un oggetto PHPMailer, occorre passare il parametro "true" per attivare le eccezioni (messaggi in caso di errore)*/
try {
    // Tentativo di creazione di una nuova istanza della classe PHPMailer, nel caso in cui siano attivate delle eccezioni
    $PHPMailer = new PHPMailer(true);

    //AUTENTICAZIONE CON SMTP

    $PHPMailer->isSMTP();
    $PHPMailer->SMTPAuth = true;
    // Dati personali
    $PHPMailer->Host = "smtp.gmail.com";
    $PHPMailer->Port = 587;
    $PHPMailer->Username = "ecommercesiteforthebest@gmail.com";
    //questa è la password per app, un codice di 16 caratteri che ti permette di accedere all'account in casi tipo questo
    //senza mettere la password effettiva, per maggiore sicurezza.
    $PHPMailer->Password = "bkuq hsqy vbgg ndvr";
    $PHPMailer->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;

    //Quarto passaggio: specificare il destinatario dell’e-mail

    // Mittente
    $PHPMailer->setFrom('ecommercesiteforthebest@gmail.com', 'E-Commerce Shop');
    // Destinatario, opzionalmente può essere specificato anche il nome
    $PHPMailer->addAddress($mail);
    // Copia
    $PHPMailer->addCC('ecommercesiteforthebest@gmail.com');
    // Copia nascosta
    $PHPMailer->addBCC('ecommercesiteforthebest@gmail.com', 'nome');

    //Quinto passaggio: aggiungere il contenuto del messaggio di posta

    $PHPMailer->isHTML(true);
    // Oggetto
    $PHPMailer->Subject = 'CODICE RECUPERO PASSWORD ACCOUNT PIXELMARKET';
    // Contenuto HTML
    $PHPMailer->Body = 'Salve, il suo codice da inserire per il recupero password è: [' . $codice . ']';
    //$PHPMailer->AltBody = 'Il testo come semplice elemento testuale';
    // Aggiungere un allegato
    //$PHPMailer->addAttachment("/home/user/Desktop/immagineesempio.png", "immagineesempio.png");


    //Sesto passaggio: utilizzare la corretta codifica dei caratteri
    $PHPMailer->CharSet = 'UTF-8';
    $PHPMailer->Encoding = 'base64';


    //Settimo passaggio: inviare l’e-mail
    $PHPMailer->send();


    //inserisco l'input del codice, per verificare che sia corretto
    //TODO manda all'inizio al controllo con il name codiceInserito

    $_SESSION["codiceGenerato"] = $codice;
    $_SESSION["mail"] = $mail;
    echo "<form action='' method='POST'>";
    echo "Codice ricevuto per mail: ";
    echo "<input type='number' maxlength='6' minlength='6'name='codiceInserito' required><br>";
    echo "<button>INVIA</button>";
    echo "</form>";


} catch (Exception $e) {
    echo "Mailer Error: " . $e->getMessage();
}


?>