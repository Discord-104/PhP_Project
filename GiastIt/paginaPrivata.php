<?php
    require_once("Prodotto.php");
    require_once("Ordine.php");
    session_start();

    // Verifica se la sessione contiene ordini esistenti
    if (!isset($_SESSION['ordini'])) {
        $_SESSION['ordini'] =  new Ordine("A", "B", "C"); //fare un costruttore di default
    }

   
    // Aggiungi prodotti all'ordine
    $_SESSION['ordini'] ->aggiungiProdotto(new Prodotto("Pizza Margherita", "Pizza con pomodoro e mozzarella", 8));
    $_SESSION['ordini'] ->aggiungiProdotto(new Prodotto("Kebap", "Kebap classico con carne e verdure", 12));
    $_SESSION['ordini'] ->aggiungiProdotto(new Prodotto("Coca Cola", "Bibita gasata", 2));

    

    // Visualizza gli ordini
?>




<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prodotti - GiastIt</title>
    <link rel="stylesheet" href="CSS/prodotti.css">
</head>
<body>
    <header>
        <h1>Menu Prodotti</h1>
    </header>
    <main>
        <h2>Pizze</h2>
        <ul>
            <li>
                <div class="prodotto">
                    <img src="IMG/Pasto/Pizza.jpeg" alt="Pizza Margherita">
                    <div class="info">
                        <h3>Pizza Margherita</h3>
                        <p>Même si j'étais exilé sur une île le service était rapide et efficace, puis la pizza de GiastIt je dois dire sublime, si 
                            j'avais su avant qu'un service similaire existait j'aurais parié mon cornichon dessus</p>
                        <p>Prezzo: €8</p>
                    </div>
                </div>
                <form action="carrello.php" method="get">
                    <input type="hidden" name="prodotto" value="Pizza Margherita">
                    <input type="hidden" name="prezzo" value="8">
                    <button type="submit">Aggiungi al carrello</button>
                </form>
            </li>

            <li>
                <div class="prodotto">
                    <img src="IMG/Pasto/Pizza2.jpeg" alt="Pizza Pepperoni">
                    <div class="info">
                        <h3>Pizza Pepperoni</h3>
                        <p>Delicious pizza like the GiastIt management system, calm and patient especially with my friend 
                            Deadpool who locked him in the fridge, obviously the tip was due for such a charitable gesture</p>
                        <p>Prezzo: €10</p>
                    </div>
                </div>
                <form action="carrello.php" method="get">
                    <input type="hidden" name="prodotto" value="Pizza Pepperoni">
                    <input type="hidden" name="prezzo" value="10">
                    <button type="submit">Aggiungi al carrello</button>
                </form>
            </li>
            <li>
                <div class="prodotto">
                    <img src="IMG/Pasto/Pizza3.jpeg" alt="Pizza vegetariana">
                    <div class="info">
                        <h3>Pizza vegetariana</h3>
                        <p>ordinala e ti faccio scordare come mangiare cibi solidi razza di parassita vegano di sto carciofo.</p>
                        <p>Prezzo: €20</p>
                    </div>
                </div>
                <form action="carrello.php" method="get">
                    <input type="hidden" name="prodotto" value="Pizza vegetariana">
                    <input type="hidden" name="prezzo" value="20">
                    <button type="submit">Aggiungi al carrello</button>
                </form>
            </li>
        </ul>

        <h2>kebap</h2>
        <ul>
            <li>
                <div class="prodotto">
                    <img src="IMG/Pasto/Kebap.jpeg" alt="Kebap">
                    <div class="info">
                        <h3>Kebap</h3>
                        <p>Un Kebap classico creato seguendo la tradizionale ricetta del nostro kebabbaro di fiducia
                            quindi troverete all'interno peli, sudore e bestemmie.
                        </p>
                        <p>Prezzo: €12</p>
                    </div>
                </div>
                <form action="carrello.php" method="get">
                    <input type="hidden" name="prodotto" value="Kebap">
                    <input type="hidden" name="prezzo" value="12">
                    <button type="submit">Aggiungi al carrello</button>
                </form>
            </li>

            <li>
                <div class="prodotto">
                    <img src="IMG/Pasto/Kebap2.jpeg" alt="Kebap vegano">
                    <div class="info">
                        <h3>Kebap vegano</h3>
                        <p>Kebap vegano per gli scemi che rispettano gli animali, visto che lasciate la carne a esseri
                            nettamente superiori (come il sottoscritto) il nostro kebabbaro ha usato una sua ricetta antica ovvero 
                            che le verdure sanno effetivamente di carne così almeno potete sentirvi inclusi all'interno della
                            società (non è vero fate schifo ugualmente).</p>
                        <p>Prezzo: €40</p>
                    </div>
                </div>
                <form action="carrello.php" method="get">
                    <input type="hidden" name="prodotto" value="Kebap vegano">
                    <input type="hidden" name="prezzo" value="40">
                    <button type="submit">Aggiungi al carrello</button>
                </form>
            </li>
            <li>
                <div class="prodotto">
                    <img src="IMG/Pasto/Kebap3.jpeg" alt="Kebap carne">
                    <div class="info">
                        <h3>Kebap extra carne</h3>
                        <p>L'extra carne ovviamente l'abbiamo presa da chi ha osato ordinare la pizza vegana, se vuoi una 
                            dimostrazione pratica ordinala.</p>
                        <p>Prezzo: €25</p>
                    </div>
                </div>
                <form action="carrello.php" method="get">
                    <input type="hidden" name="prodotto" value="Kebap carne">
                    <input type="hidden" name="prezzo" value="25">
                    <button type="submit">Aggiungi al carrello</button>
                </form>
            </li>
        </ul>

        <h2>Bevande</h2>
        <ul>
            <li>
                <div class="prodotto">
                    <img src="IMG/Bibite/B.jpeg" alt="Coca Cola">
                    <div class="info">
                        <h3>Coca Cola</h3>
                        <p>biting people's heads off leaves a taste of iron in my mouth, 
                            luckily I always order from GiustIt for my cola cola.</p>
                        <p>Prezzo: €2</p>
                    </div>
                </div>
                <form action="carrello.php" method="get">
                    <input type="hidden" name="prodotto" value="Coca Cola">
                    <input type="hidden" name="prezzo" value="2">
                    <button type="submit">Aggiungi al carrello</button>
                </form>
            </li>

            <li>
                <div class="prodotto">
                    <img src="IMG/Bibite/B2.jpeg" alt="Latte">
                    <div class="info">
                        <h3>Latte</h3>
                        <p>Why are you so serious? Here, drink some milk made 100% by me.</p>
                        <p>Prezzo: €1</p>
                    </div>
                </div>
                <form action="carrello.php" method="get">
                    <input type="hidden" name="prodotto" value="Latte">
                    <input type="hidden" name="prezzo" value="1">
                    <button type="submit">Aggiungi al carrello</button>
                </form>
            </li>

            <li>
                <div class="prodotto">
                    <img src="IMG/Bibite/B3.jpeg" alt="Sprite">
                    <div class="info">
                        <h3>Sprite</h3>
                        <p>To calm my hot spirits I always drink my GiustIt sprite, also highly recommended for the service.</p>
                        <p>Prezzo: €3</p>
                    </div>
                </div>
                <form action="carrello.php" method="get">
                    <input type="hidden" name="prodotto" value="Sprite">
                    <input type="hidden" name="prezzo" value="3">
                    <button type="submit">Aggiungi al carrello</button>
                </form>
            </li>
        </ul>
        <h2>Dessert</h2>
        <ul>
            <li>
                <div class="prodotto">
                    <img src="IMG/Dessert/D.jpeg" alt="Panna Cotta">
                    <div class="info">
                        <h3>Panna Cotta</h3>
                        <p>Panna Cotta semplicissima ma gustosa ed è per questo che amo GiastIt,
                            per favore hanno rapito mia moglie e i miei figli e mi stanno puntando
                            una pistola in fronte vi prego chiamate il 112 prima che sia troppo
                            tardi.</p>
                        <p>Prezzo: €5</p>
                    </div>
                </div>
                <form action="carrello.php" method="get">
                    <input type="hidden" name="prodotto" value="Panna COtta">
                    <input type="hidden" name="prezzo" value="5">
                    <button type="submit">Aggiungi al carrello</button>
                </form>
            </li>

            <li>
                <div class="prodotto">
                    <img src="IMG/Dessert/D2.jpeg" alt="Tiramisu">
                    <div class="info">
                        <h3>Tiramisù</h3>
                        <p>Non solo il Tiramisù era ottimo, ma anche consegnato in tempi rapidissimi e questa semplice azione 
                            mi riporta alla mente che quando c'era Mewtwo il treno per Zafferanopoli arrivava sempre 
                            in orario (Mew se stai leggendo questo sappi noi del Team Rocket ti prenderemo e butteremo
                            il tuo corpo nel percorso 24).</p>
                        <p>Prezzo: €6</p>
                    </div>
                </div>
                <form action="carrello.php" method="get">
                    <input type="hidden" name="prodotto" value="Tiramisu">
                    <input type="hidden" name="prezzo" value="6">
                    <button type="submit">Aggiungi al carrello</button>
                </form>
            </li>

            <li>
                <div class="prodotto">
                    <img src="IMG/Dessert/D3.jpeg" alt="Torta al cioccolato">
                    <div class="info">
                        <h3>Torta al cioccolato</h3>
                        <p>Banalissima torta al cioccolato, fatta senza usare il cioccolato.</p>
                        <p>Prezzo: €3</p>
                    </div>
                </div>
                <form action="carrello.php" method="get">
                    <input type="hidden" name="prodotto" value="Torta al cioccolato">
                    <input type="hidden" name="prezzo" value="3">
                    <button type="submit">Aggiungi al carrello</button>
                </form>
            </li>
        </ul>
    </main>
    <footer>
        <p>
            <img src="IMG/Logo.jpeg" alt="Logo" class="logo-copyright">
            &copy; 2024 GiastIt. Tutti i diritti riservati.
        </p>
    </footer>
</body>
</html>
