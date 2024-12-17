<?php
    class Prodotto {
        private $nome;
        private $descrizione;
        private $prezzo;

        public function __construct($nome, $descrizione, $prezzo) {
            $this->nome = $nome;
            $this->descrizione = $descrizione;
            $this->prezzo = $prezzo;
        }

        public function getNome() {
            return $this->nome;
        }

        public function getDescrizione() {
            return $this->descrizione;
        }

        public function getPrezzo() {
            return $this->prezzo;
        }
    }
?>