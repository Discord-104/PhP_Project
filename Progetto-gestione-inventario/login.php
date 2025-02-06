<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LOGIN</title>
</head>

<body>
<style>/* Stile generale della pagina */
body {
    font-family: 'Arial', sans-serif;
    background-color:rgb(0, 0, 0);
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
    display: flex;
    flex-direction: column;
    align-items: center;
}

/* Gruppo di input */
.input-group {
    width: 100%;
    margin-bottom: 15px;
    text-align: center;
}

/* Stile per i titoli dei campi */
h4 {
    color: #87CEEB;
    margin-bottom: 5px;
    margin-top: 15px;
    text-align: center;
}

/* Stile per gli input */
input[type="text"], 
input[type="password"] {
    width: 80%;
    padding: 10px;
    margin: 5px auto;
    border: 2px solid #87CEEB;
    border-radius: 5px;
    background-color: #000000;
    color: white;
    font-size: 1em;
    display: block;
}

input[type="text"]:focus, 
input[type="password"]:focus {
    outline: none;
    border-color: #ffffff;
    box-shadow: 0 0 5px rgba(135, 206, 235, 0.5);
}

/* Stile per il pulsante di invio */
input[type="submit"] {
    background-color: #87CEEB;
    color: #000000;
    border: none;
    padding: 12px 25px;
    font-size: 1em;
    cursor: pointer;
    border-radius: 5px;
    font-weight: bold;
    margin-top: 20px;
    transition: all 0.3s ease;
    width: auto;
}

input[type="submit"]:hover {
    background-color: #ffffff;
    transform: scale(1.05);
}

/* Stile per il pulsante recupera password */
button {
    background-color: transparent;
    color: #87CEEB;
    border: 2px solid #87CEEB;
    padding: 12px 25px;
    margin-top: 20px;
    font-size: 0.9em;
    cursor: pointer;
    border-radius: 5px;
    transition: all 0.3s ease;
}

button:hover {
    background-color:rgb(233, 56, 56);
    border-color: rgb(0, 0, 0);
    color: #000000;
}

/* Stile per il messaggio di errore */
.messaggio {
    color: #ffffff;
    background-color: rgba(135, 206, 235, 0.2);
    padding: 10px;
    border-radius: 5px;
    margin-bottom: 20px;
    text-align: center;
    width: 100%;
}
</style>
    <?php
    if (isset($_SESSION)){
        session_unset();
        session_destroy();
    }

    if (isset($_GET["messaggio"]))
        echo $_GET["messaggio"];
    ?>

    <form action="gestoreLogin.php" method="POST">
        <h4>Username: </h4> <input type="text" name="username" required>
        <br>
        <h4>Password: </h4> <input type="password" name="password" required>
        <br>

        <input type="submit" value="INVIA">

    </form>
    <button onclick="window.location.href='inputMail.php';">RECUPERA PASSWORD</button>

</body>

</html>