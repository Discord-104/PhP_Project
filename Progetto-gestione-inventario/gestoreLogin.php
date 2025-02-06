<?php

if (!isset($_SESSION))
    session_start();


if (!isset($_POST["username"]) || !isset($_POST["password"])) {
    header("location: login.php?messaggio=Username o Password non inseriti");
    exit;
}

//se passa li salvo
$username = $_POST["username"];
$password = $_POST["password"];

//faccio i controlli sui dati inseriti

//prendo il file con tutte le credenziali
$contenutoFileCredenziali = file_get_contents("./files/credenziali.csv");


//lo divido in righe
$righeFileCredenziali = explode("\r\n", $contenutoFileCredenziali);

print_r($righeFileCredenziali);

foreach ($righeFileCredenziali as $riga) {
    //suddivido la riga nei campi che la compongono
    $campi = explode(";", $riga);
    //mi servono solo i primi due campi (username e password)
    //controllo le corrispondenze
    if ($username == $campi[0] && $password == $campi[1]) {
        echo $username . " - " .$password;
        //se le credenziali corrispondono
        $_SESSION["autenticato"] = $campi[2];
        $_SESSION["password"] = $campi[1]; //mi serve per il pagamento perchè voglio usare la password per confermare l'identità e lo user
        $_SESSION["username"] = $campi[0];
        header("location: redirect.php?username=" . $campi[0]);
        exit;
    }
}

//se non entro mai nel controllo finisco qui, e no, non è un bene
header("location: login.php?messaggio=Credenziali errate");
exit;

?>