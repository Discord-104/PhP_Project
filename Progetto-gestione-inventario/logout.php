<?php
if (!isset($_SESSION))
    session_start();

if (count($_POST) != 0) {
    if ($_POST["conferma"] == "si") {
        header("location:gestoreLogout.php");
        exit;
    } else if ($_POST["conferma"] == "no") {
        header("Location: ./pagineUtenti/" . $_SESSION["username"] . ".php");
        exit;
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LOGOUT</title>
</head>

<body>

    <style>
        /* Stile generale della pagina */
        body {
            font-family: 'Arial', sans-serif;
            background-color: #000000;
            color: #ffffff;
            margin: 0;
            padding: 20px;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }

        /* Stile per il form */
        form {
            background-color: rgba(255, 255, 255, 0.1);
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.5);
            width: 100%;
            max-width: 400px;
            text-align: center;
        }

        /* Stile per il titolo della domanda */
        h3 {
            color: #87CEEB;
            margin-bottom: 25px;
            font-size: 1.2em;
        }

        /* Container per i radio button */
        .radio-group {
            margin: 20px 0;
            text-align: center;
        }

        /* Stile per i radio button e le loro label */
        input[type="radio"] {
            margin: 10px;
            cursor: pointer;
            accent-color: #87CEEB;
        }

        input[type="radio"]+br {
            margin-bottom: 10px;
        }

        /* Stile per il pulsante */
        button {
            background-color: #87CEEB;
            color: #000000;
            border: none;
            padding: 12px 25px;
            margin-top: 20px;
            font-size: 1em;
            cursor: pointer;
            border-radius: 5px;
            font-weight: bold;
            transition: all 0.3s ease;
        }

        button:hover {
            background-color: #ffffff;
            transform: scale(1.05);
        }
    </style>
    <form action="" method="post">
        <h3>Confermi di voler uscire dall'account?</h3>
        <input type="radio" name="conferma" value="si"> SI <br>
        <input type="radio" name="conferma" value="no"> NO <br>
        <button>CONFERMA</button>
    </form>
</body>

</html>