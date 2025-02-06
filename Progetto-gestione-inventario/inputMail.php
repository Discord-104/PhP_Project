<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>recuperaPassword</title>
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

        /* Label per l'email */
        form label {
            color: #87CEEB;
            display: block;
            margin-bottom: 15px;
            font-size: 1em;
        }

        /* Stile per l'input email */
        input[type="email"] {
            width: 80%;
            padding: 12px;
            margin: 10px auto;
            border: 2px solid #87CEEB;
            border-radius: 5px;
            background-color: #000000;
            color: white;
            font-size: 1em;
            display: block;
        }

        input[type="email"]:focus {
            outline: none;
            border-color: #ffffff;
            box-shadow: 0 0 5px rgba(135, 206, 235, 0.5);
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
    <form action="recuperaPassword.php" method="POST">
        <?php


        if(isset($_GET["messaggio"]))
            echo $_GET["messaggio"];

        ?>
        e-mail per effettuare il recupero della password: <input type="email" name="mail" required><br>
        <button>INVIA</button>

    </form>
</body>

</html>