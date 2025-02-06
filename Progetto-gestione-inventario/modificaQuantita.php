<?php

if (!isset($_SESSION))
    session_start();

if (!hash_equals($_SESSION["username"], "admin")) {
    header("Location: login.php?messaggio=Non hai i permessi per accedere a questa pagina");
    exit;
}

if (!isset($_POST)) {
    header("Location: DettagliProdotto.php");
    exit;
}

// Usa direttamente $_POST["qMod"] come valore numerico
$quantita = (int) $_POST["qMod"]; // Converti in numero intero

// Leggi il file prodotti
$prodotti = file_get_contents("./prodotti/datas/prodotti.csv");

$righeProdotti = explode("\r\n", $prodotti);

foreach ($righeProdotti as $riga) {
    $campi = explode(";", $riga);

    if ($campi[0] == $_POST["IDprodotto"]) {
        // Usa direttamente $campi[7] come valore numerico
        $qAttuale = (int) $campi[7];

        if ($quantita <= 0) {
            $qAttuale -= abs($quantita); // Sottrai in caso di decremento
        } else {
            $qAttuale += $quantita; // Aggiungi in caso di incremento
        }

        if ($qAttuale <= 0) {
            // Rimuovi il prodotto se la quantità è <= 0
            $nuovaListaProdotti = [];
            foreach ($righeProdotti as $linea) {
                $dati = explode(";", $linea);
                if ($dati[0] != $_POST["IDprodotto"]) {
                    $nuovaListaProdotti[] = $linea;
                }
            }
        } else {
            // Aggiorna la quantità del prodotto
            $nuovaListaProdotti = [];
            foreach ($righeProdotti as $linea) {
                $dati = explode(";", $linea);
                if ($dati[0] == $_POST["IDprodotto"]) {
                    $dati[7] = $qAttuale; // Aggiorna la quantità
                    $nuovaListaProdotti[] = implode(";", $dati);
                } else {
                    $nuovaListaProdotti[] = $linea;
                }
            }
        }

        // Sovrascrivi il file prodotti
        $path = "./prodotti/datas/prodotti.csv";
        file_put_contents($path, implode("\r\n", $nuovaListaProdotti));
        break;
    }
}

header("location: pagineUtenti/admin.php");
exit;

?>