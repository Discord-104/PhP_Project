<?php
    $conn = new mysqli("localhost", "root", "", "voti_db");

    if ($conn->connect_errno) {
        die("Errore di connessione: " . $conn->connect_error);
    }
?>
