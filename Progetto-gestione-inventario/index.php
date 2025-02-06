<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FNFK</title>
</head>

<body>
    <style>
        /* Stile generale della pagina */
        body {
            font-family: 'Arial', sans-serif;
            background-color:rgb(0, 0, 0);
            color:rgb(0, 13, 255);
            margin: 0;
            padding: 20px;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }

        /* Stile per il titolo */
        h1 {
            color:rgb(255, 255, 255);
            text-align: center;
            font-size: 2.5em;
            margin-bottom: 40px;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
            letter-spacing: 2px;
        }

        /* Stile per i pulsanti */
        button {
            background-color:rgb(0, 174, 255);
            color: white;
            border: none;
            padding: 15px 30px;
            margin: 10px;
            font-size: 1.2em;
            cursor: pointer;
            border-radius: 5px;
            transition: all 0.3s ease;
            text-transform: uppercase;
            font-weight: bold;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        button:hover {
            background-color: #cc0000;
            transform: scale(1.05);
            box-shadow: 0 6px 8px rgba(0, 0, 0, 0.2);
        }

        /* Effetto focus per accessibilità */
        button:focus {
            outline: 3px solid #ffffff;
            outline-offset: 2px;
        }
    </style>
    <h1>BENVENUTO A PIXELMARKET!</h1>


    <button onclick="window.location.href='login.php';">LOGIN</button>
    <br>
    <button onclick="window.location.href='registrazione.php';">REGISTRATI</button>

</body>

</html>