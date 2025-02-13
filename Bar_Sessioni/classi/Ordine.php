<?php
    class Ordine {
        private $nome;
        private $cognome;
        private $classe;
        private $pasto;
        private $bevanda;

        public function __construct($nome, $cognome, $classe) {
            $this->nome = $nome;
            $this->cognome = $cognome;
            $this->classe = $classe;
        }

        public function setPasto($pasto) {
            $this->pasto = $pasto;
        }

        public function setBevanda($bevanda) {
            $this->bevanda = $bevanda;
        }

        public function getNome() {
            return $this->nome;
        }

        public function getCognome() {
            return $this->cognome;
        }

        public function getClasse() {
            return $this->classe;
        }

        public function getPasto() {
            return $this->pasto;
        }

        public function getBevanda() {
            return $this->bevanda;
        }
    }
?>
