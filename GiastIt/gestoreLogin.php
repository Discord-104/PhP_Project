<?php
    require_once("classi/Utente.php");
    require_once("classi/Ordine.php");
    require_once("classi/GestoreUtenti.php"); 
    session_start();

    // Creazione degli utenti
    $utenti = [
        new Utente('utenteStandard', 'passStandard', false),
        new Utente('utentePRO', 'passPro', true)
    ];

    $gestoreUtenti = new GestoreUtenti($utenti);

    // Controllo se sono state inviate le credenziali
    if (isset($_GET["username"]) && isset($_GET["password"])) {
        $username = $_GET["username"];
        $password = $_GET["password"];
        
        // Verifica le credenziali
        $utente = $gestoreUtenti->verificaCredenziali($username, $password);

        if ($utente) {
            // Imposta la sessione
            $_SESSION["autenticato"] = true;

            if ($utente->isPro()) {
                $_SESSION["tipo_utente"] = "pro";
            } else {
                $_SESSION["tipo_utente"] = "standard";
            }

            // Crea un nuovo ordine
            $_SESSION["ordine"] = new Ordine();

            // Reindirizza a una pagina privata
            header("Location: paginaPrivata.php");
            exit();
        } else {
            // Credenziali errate
            header("Location: login.php?messaggio=Credenziali+errate%2C+riprovare");
            exit();
        }
    } else {
        // Se non sono state inviate credenziali, reindirizza al login
        header("Location: login.php");
        exit();
    }
?>
