<?php
    require_once("classi/db.php");
    session_start();

    if (!isset($_SESSION['studente_id'])) {
        die("Accesso negato!");
    }
    
    if (isset($_POST['materia']) && isset($_POST['voto'])) {
        $materia_id = $_POST['materia'];
        $voto = $_POST['voto'];
        $studente_id = $_SESSION['studente_id'];

        

        $q_voto = "INSERT INTO voti (studente_id, materia_id, voto) VALUES ('$studente_id', '$materia_id', '$voto')";
        $conn->query($q_voto);
    }

    // Recupera tutte le materie dal database
    $q_materie = "SELECT id, nome FROM materie";
    $result_materie = $conn->query($q_materie);
?>

<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="CSS/style.css">
    <title>Inserimento Voto</title>
</head>
<body>
    <form method="post">
        <label for="materia">Seleziona la Materia</label>
        <select name="materia" id="materia" required>
            <option value="">-- Seleziona Materia --</option>
            <?php
                if ($result_materie->num_rows > 0) {
                    while ($row = $result_materie->fetch_assoc()) {
                        echo "<option value='{$row['id']}'>{$row['nome']}</option>";
                    }
                } else {
                    echo "<option value=''>Nessuna materia disponibile</option>";
                }
            ?>
        </select>

        <label for="voto">Inserisci il Voto</label>
        <input type="number" name="voto" step="0.1" placeholder="Voto" required>

        <button type="submit">Aggiungi Voto</button>

        <a href="lista_voti.php">
            <button type="button">Visualizza i tuoi voti</button>
        </a>
    </form>

   
</body>
</html>
