<?php
require_once("classes/Prodotto.php");
require_once("classes/Utente.php");

session_start();

// Carica utenti dal CSV
$utenti = Utente::caricaUtenti("files/credenziali.csv");

// Dati inviati tramite POST
$username = $_SESSION['username'];
$password = $_SESSION['password'];

// Trova l'utente corrispondente nel CSV
$utenteTrovato = null;
foreach ($utenti as $utente) {
    if ($utente->getUsername() === $username && $utente->getPassword() === $password) {
        $utenteTrovato = $utente;
        break;
    }
}

// Se l'utente non esiste, mostra un errore
if (!$utenteTrovato) {
    echo "Errore: Utente non trovato o credenziali errate.";
    exit();
}

// Verifica se il carrello esiste
if (isset($_SESSION['carrello'])) {
    $carrello = $_SESSION['carrello'];
} else {
    $carrello = [];
}

// Calcola il totale e applica lo sconto PRO se necessario
$totale = 0;
$isPro = false;
if ($utenteTrovato->getRole() === 'P') {
    $isPro = true; // Utente PRO
}

foreach ($carrello as $prodotto) {
    $prezzo = $prodotto['prezzo'] * $prodotto['quantita'];
    $totale += $prezzo;
}

if ($isPro) {
    $totale *= 0.5; // Sconto 50% per PRO
}

// Aggiorna il CSV dei prodotti e svuota il carrello
if (!empty($carrello)) {
    $prodotti = Prodotto::caricaProdotti('prodotti/datas/prodotti.csv');
    foreach ($carrello as $prodottoCarrello) {
        foreach ($prodotti as $prodottoMagazzino) {
            if ($prodottoCarrello['IDprodotto'] === $prodottoMagazzino->getIDprodotto()) {
                // Uso il getter per ottenere la quantità
                $nuovaQuantita = $prodottoMagazzino->getQuantita() - $prodottoCarrello['quantita'];

                // Uso un setter per aggiornare la quantità (se disponibile)
                $prodottoMagazzino->setQuantita(max(0, $nuovaQuantita));
            }
        }
    }

    // Riscrive il CSV aggiornato
    $csvContent = "";

    foreach ($prodotti as $prodotto) {
        $csvContent .= $prodotto->getIDprodotto() . ";";
        $csvContent .= $prodotto->getNome() . ";";
        $csvContent .= $prodotto->getDescrizione() . ";";
        $csvContent .= $prodotto->getFornitore() . ";";
        $csvContent .= $prodotto->getPrezzo() . ";";
        $csvContent .= $prodotto->getPathImmagine() . ";";
        $csvContent .= $prodotto->getTipo() . ";";
        $csvContent .= $prodotto->getQuantita() . "\r\n";
    }

    // Scrivi tutto il contenuto aggiornato nel file
    file_put_contents('prodotti/datas/prodotti.csv', $csvContent);

    // Svuota il carrello
    $_SESSION['carrello'] = [];
}
?>

<!DOCTYPE html>
<html lang="it">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riepilogo Ordine</title>
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
            margin-bottom: 30px;
            font-size: 2em;
            text-align: center;
        }

        /* Contenitore riepilogo */
        .riepilogo {
            background-color: rgba(255, 255, 255, 0.1);
            padding: 30px;
            border-radius: 10px;
            width: 100%;
            max-width: 600px;
            margin-bottom: 20px;
            box-shadow: 0 0 10px rgba(135, 206, 235, 0.5);
            border: 1px solid #87CEEB;
        }

        /* Testo del riepilogo */
        .riepilogo p {
            margin: 10px 0;
            line-height: 1.5;
            color: #ffffff;
        }

        /* Lista prodotti */
        ul {
            list-style-type: none;
            padding: 0;
            margin: 0;
        }

        ul li {
            background-color: rgba(255, 255, 255, 0.05);
            margin-bottom: 10px;
            padding: 15px;
            border-radius: 5px;
            border: 1px solid #87CEEB;
        }

        ul li strong {
            color: #87CEEB;
        }

        /* Totale */
        .totale {
            font-weight: bold;
            font-size: 1.2em;
            color: #ffffff;
            text-align: center;
            margin-top: 20px;
        }

        /* Link */
        a {
            display: inline-block;
            color: #87CEEB;
            text-decoration: none;
            font-weight: bold;
            margin: 10px;
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
            .riepilogo {
                padding: 20px;
            }

            ul li {
                padding: 10px;
            }

            a {
                margin: 5px;
                padding: 8px 10px;
            }
        }
    </style>

</head>

<body>
    <h1>Riepilogo Ordine</h1>

    <div class="riepilogo">
        <h2>Dati Utente</h2>
        <p><strong>Username:</strong> <?php echo $utenteTrovato->getUsername(); ?></p>
        <p><strong>Ruolo:</strong> <?php echo $utenteTrovato->getRole(); ?></p>

    </div>

    <div class="riepilogo">
        <h2>Prodotti Ordinati</h2>
        <ul>
            <?php
            foreach ($carrello as $prodotto) {
                echo '<li>';
                echo '<strong>' . $prodotto['nome'] . '</strong> - ';
                echo $prodotto['Descrizione'] . '<br>';
                echo 'Quantità: ' . $prodotto['quantita'] . '<br>';
                echo 'Prezzo: €' . number_format($prodotto['prezzo'], 2);
                echo '</li>';
            }
            ?>
        </ul>
        <p class="totale">
            <?php
            if ($isPro) {
                echo 'Totale (sconto PRO 50% applicato): €' . number_format($totale, 2);
            } else {
                echo 'Totale: €' . number_format($totale, 2);
            }
            ?>
        </p>
    </div>
    <a href="carrello.php">Torna al Carrello</a>
    <?php

    echo "<a href='pagineUtenti/" . $_SESSION["username"] . ".php'>Torna alla Home Page</a>";

    $utenti = file_get_contents("./files/credenziali.csv");

    $righe = explode("\r\n", $utenti);

    foreach ($righe as $riga) {
        $campi = explode(";", $riga);

        if (hash_equals($campi[0], $_SESSION["username"])) {
            $mail = $campi[5];
        }
    }

    if ($mail === null) {
        header("location: login.php?messaggio=mail non esistente");
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
        $PHPMailer->Subject = 'CONFERMA ORDINE';
        // Contenuto HTML
        $corpo = 'Salve, il suo ordine è stato confermato, il riepilogo:';
        foreach ($carrello as $prodotto) {
            $corpo .= '<li>';
            $corpo .= '<strong>' . $prodotto['nome'] . '</strong> - ';
            $corpo .= $prodotto['Descrizione'] . '<br>';
            $corpo .= 'Quantità: ' . $prodotto['quantita'] . '<br>';
            $corpo .= 'Prezzo: €' . number_format($totale, 2);
            $corpo .= '</li>';
        }
        $PHPMailer->Body = $corpo;
        //$PHPMailer->AltBody = 'Il testo come semplice elemento testuale';
        // Aggiungere un allegato
        //$PHPMailer->addAttachment("/home/user/Desktop/immagineesempio.png", "immagineesempio.png");
    

        //Sesto passaggio: utilizzare la corretta codifica dei caratteri
        $PHPMailer->CharSet = 'UTF-8';
        $PHPMailer->Encoding = 'base64';


        //Settimo passaggio: inviare l’e-mail
        $PHPMailer->send();

    } catch (Exception $e) {
        echo "Mailer Error: " . $e->getMessage();
    }


    ?>
</body>

</html>