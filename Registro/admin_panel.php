<?php
    require_once("classi/db.php");
    require_once("classi/Studente.php");
    session_start();

    if (!isset($_SESSION['studente_id']) || !isset($_SESSION['is_admin']) || !$_SESSION['is_admin']) {
        die("Accesso negato!");
    }

    // Aggiunta Materia
    if (isset($_POST['aggiungi']) && !empty($_POST['nome_materia'])) {
        $nome_materia = $_POST['nome_materia'];
        $query = "INSERT INTO materie (nome) VALUES ('$nome_materia')";
        $conn->query($query);
    }

    // Rimozione Materia
    if (isset($_POST['rimuovi']) && !empty($_POST['materia_nome'])) {
        $materia_nome = $_POST['materia_nome'];
        $query = "DELETE FROM materie WHERE nome = '$materia_nome'";
        $conn->query($query);
    }

    // Modifica Materia
    if (isset($_POST['modifica']) && !empty($_POST['materia_nome']) && !empty($_POST['nuovo_nome'])) {
        $materia_nome = $_POST['materia_nome'];
        $nuovo_nome = $_POST['nuovo_nome'];
        $query = "UPDATE materie SET nome = '$nuovo_nome' WHERE nome = '$materia_nome'";
        $conn->query($query);
    }

    // Recupera materie
    $query_materie = "SELECT nome FROM materie";
    $result_materie = $conn->query($query_materie);
?>

<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <title>Gestione Materie</title>
    <link rel="stylesheet" href="CSS/admin.css">
</head>
    <body>

        <h1>Gestione Materie</h1>

        <div class="form-container">
            <form method="post">
                <label for="nome_materia">Aggiungi una nuova materia:</label>
                <input type="text" id="nome_materia" name="nome_materia" placeholder="Nome nuova materia" required>
                <button type="submit" name="aggiungi">Aggiungi</button>
            </form>
        </div>

        <h2>Materie Esistenti</h2>

        <div class="table-container">
            <table>
                <tr>
                    <th>Nome</th>
                    <th>Azioni</th>
                </tr>
                <?php while ($row = $result_materie->fetch_assoc()) { ?>
                    <tr>
                        <td><?= $row['nome'] ?></td>
                        <td>
                            <form method="post" style="display:inline;">
                                <input type="hidden" name="materia_nome" value="<?= $row['nome'] ?>">
                                <button type="submit" name="rimuovi">Rimuovi</button>
                            </form>
                            <form method="post" style="display:inline;">
                                <input type="hidden" name="materia_nome" value="<?= $row['nome'] ?>">
                                <input type="text" name="nuovo_nome" placeholder="Nuovo Nome" required>
                                <button type="submit" name="modifica">Modifica</button>
                            </form>
                        </td>
                    </tr>
                <?php } ?>
            </table>
        </div>

        <a href="logout.php">Logout</a>

    </body>
</html>
