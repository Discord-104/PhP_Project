<?php

if (!isset($_SESSION)) {
    session_start();
}

if (!isset($_SESSION["autenticato"])) {
    header("location: login.php?messaggio= [REDIRECT] Non hai i permessi per accedere a questa pagina");
    exit;
}

print_r($_SESSION);
//faccio i controlli sui dati inseriti

//prendo il file con tutte le credenziali
$contenutoFileCredenziali = file_get_contents("./files/credenziali.csv");

//lo divido in righe
$righeFileCredenziali = explode("\r\n", $contenutoFileCredenziali);

foreach ($righeFileCredenziali as $riga) {
    //suddivido la riga nei campi che la compongono
    $campi = explode(";", $riga);
    //print_r($campi);
    //controllo le corrispondenze
    if ($_SESSION["autenticato"] == $campi[2]) {
        //i ruoli corrispondono, quindi mi muovo nella pagina dedicata
        if ($_SESSION["username"] == "admin") {
            $path = "./pagineUtenti/" . $campi[0] . ".php"; 
            if (!file_exists($path)) {
                fopen($path, "w");
                file_put_contents($path, "<?php\r\n\r\nrequire_once('..\utilities\basePaginaUtente.php');\r\n\r\n\r\nrequire_once('..\HomePageAdmin.php');\r\n\r\n?>");
            }
            header("location: " . $path);
            exit;
        } else if ($campi[0] == $_SESSION["username"]) {
            $path = "./pagineUtenti/" . $campi[0] . ".php"; 
            if (!file_exists($path)) {
                fopen($path, "w");
                file_put_contents($path, "<?php\r\n\r\nrequire_once('..\utilities\basePaginaUtente.php');\r\n\r\n\r\nrequire_once('..\HomePage.php');\r\n\r\n?>");
            }
            header("location: " . $path);
            exit;
        }
    }
}

//se non entro mai nel controllo finisco qui, e no, non è un bene
header("location: login.php?messaggio=Credenziali errate");
exit;


?>