<?php
    require_once("classi/db.php");
    require_once("classi/Studente.php");
    session_start();

    if (isset($_POST['username']) && isset($_POST['password'])) {

        $utente = Studente::login($conn, $_POST['username'], $_POST['password']);

        if ($utente) {

            $_SESSION['studente_id'] = $utente->getId();
            $_SESSION['username'] = $utente->getUsername();
            $_SESSION['is_admin'] = $utente->isAdmin();

            if ($utente->isAdmin()) {
                header("Location: admin_panel.php");
            } else {
                header("Location: voti.php");
            }
            exit;
        } else {
            echo "Credenziali errate!";
        }
    }
?>

<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="CSS/style.css">
</head>
<body>
    <form method="post">
        <?php
            if (isset($_POST['username']) && isset($_POST['password']) && !$utente) {
                echo '<p style="color: red;">Credenziali errate!</p>';
            }
        ?>
        <label for="username">Username</label>
        <input type="text" id="username" name="username" placeholder="Inserisci il tuo username" required>
        
        <label for="password">Password</label>
        <input type="password" id="password" name="password" placeholder="Inserisci la tua password" required>

        <button type="submit">Accedi</button>
    </form>
</body>
</html>
