<?php
require_once("Prodotto.php");

class Ordine {
    private $prodotti = [];
    private $totale = 0;

    public function aggiungiProdotto(Prodotto $prodotto) {
        $this->prodotti[] = $prodotto;
        $this->totale += $prodotto->getPrezzo();
    }

    public function getProdotti() {
        return $this->prodotti;
    }

    public function getTotale() {
        return $this->totale;
    }
}
?>
