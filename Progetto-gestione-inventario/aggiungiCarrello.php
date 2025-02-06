<?php
    require_once("classes/Prodotto.php");

    
    session_start();

    // Verifica se l'utente ha selezionato una quantità e l'ID del prodotto
    if (isset($_POST['IDprodotto']) && isset($_POST['quantita'])) {
        $IDprodotto = $_POST['IDprodotto'];
        $quantita = intval($_POST['quantita']); // Converte la quantità in intero

        // Carica i prodotti dal file CSV
        $prodotti = Prodotto::caricaProdotti("prodotti/datas/prodotti.csv");

        // Cerca il prodotto selezionato
        $prodottoSelezionato = null;
        foreach ($prodotti as $prodotto) {
            if ($prodotto->getIDprodotto() == $IDprodotto) {
                $prodottoSelezionato = $prodotto;
                break;
            }
        }

        if ($prodottoSelezionato !== null) {
            $quantitaDisponibile = intval($prodottoSelezionato->getQuantita()); // Ottiene la quantità disponibile dal CSV

            // Verifica che la quantità richiesta sia valida
            if ($quantita > 0 && $quantita <= $quantitaDisponibile) {
                // Aggiunge il prodotto al carrello
                if (!isset($_SESSION['carrello'])) {
                    $_SESSION['carrello'] = [];
                }

                // Verifica se il prodotto è già presente nel carrello
                $prodottoTrovato = false;
                foreach ($_SESSION['carrello'] as $index => $item) {
                    if ($item['IDprodotto'] == $IDprodotto) {
                        $quantitaTotale = $_SESSION['carrello'][$index]['quantita'] + $quantita;

                        // Controlla che la quantità totale non superi quella disponibile
                        if ($quantitaTotale <= $quantitaDisponibile) {
                            $_SESSION['carrello'][$index]['quantita'] = $quantitaTotale; // Aggiunge quantità se già presente
                            $prodottoTrovato = true;
                        } else {
                            echo "Errore: quantità richiesta superiore alla disponibilità.";
                            exit();
                        }
                        break;
                    }
                }

                if (!$prodottoTrovato) {
                    $_SESSION['carrello'][] = [
                        'IDprodotto' => $IDprodotto,
                        'quantita' => $quantita,
                        'nome' => $prodottoSelezionato->getNome(),
                        'prezzo' => $prodottoSelezionato->getPrezzo(),
                        'Descrizione' => $prodottoSelezionato->getDescrizione()
                    ];
                }

                // Redirige alla pagina del carrello
                header("Location: carrello.php");
                exit();
            } else {
                echo "Errore: quantità non valida. Disponibile: $quantitaDisponibile.";
            }
        } else {
            echo "Prodotto non trovato.";
        }
    } else {
        echo "Dati mancanti.";
    }
?>
