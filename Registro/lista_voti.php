<?php
    require_once("classi/db.php");
    session_start();

    if (!isset($_SESSION['studente_id'])) {
        die("Accesso negato!");
    }

    $studente_id = $_SESSION['studente_id'];

    // Ottiene i voti dal database con il nome della materia
    $query = "SELECT materie.nome AS materia, voti.voto FROM voti 
            JOIN materie ON voti.materia_id = materie.id 
            WHERE studente_id = '$studente_id'";

    $result = $conn->query($query);

    $voti_per_materia = [];
    $totale_voti = 0;
    $numero_voti = 0;

    while ($row = $result->fetch_assoc()) {
        $materia = $row['materia'];
        $voto = $row['voto'];
        
        $voti_per_materia[$materia][] = $voto;
        $totale_voti += $voto;
        $numero_voti++;
    }

    // Calcola la media totale
    if ($numero_voti > 0) {
        $media_totale = $totale_voti / $numero_voti;
    } else {
        $media_totale = 0;
    }

    // Determina il colore della media
    if ($media_totale < 6) {
        $classe_media = "media-rossa";
    } else {
        $classe_media = "media-verde";
    }
?>

<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <title>Lista Voti</title>
    <link rel="stylesheet" href="CSS/style.css">
</head>
<body>
    <div class="container">
        <h1>Lista Voti</h1>

        <!-- Tabella per i voti -->
        <table>
            <thead>
                <tr>
                    <th>Materia</th>
                    <th>Voto</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                foreach ($voti_per_materia as $materia => $voti) { 
                    foreach ($voti as $voto) {
                        // Determina il colore del voto
                        if ($voto <= 5) {
                            $classe_voto = "voto-rosso";
                        } else {
                            $classe_voto = "voto-verde";
                        }

                        // Visualizza la riga della tabella
                        echo "<tr><td>$materia</td><td class='$classe_voto'>$voto</td></tr>";
                    }
                }
                ?>
            </tbody>
        </table>

        <!-- Media Totale -->
        <h2>Media Totale: <span class="media <?php echo $classe_media; ?>"><?php echo number_format($media_totale, 2); ?></span></h2>
        
        <a href="logout.php">Logout</a>
    </div>
</body>
</html>
