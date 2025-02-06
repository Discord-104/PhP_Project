<?php
    class Prodotto
    {
        private $IDprodotto;
        private $Nome;
        private $Descrizione;
        private $Fornitore;
        private $Prezzo;
        private $pathImmagine;
        private $tipo;
        private $quantita;

        public function __construct($IDprodotto, $Nome, $Descrizione, $Fornitore, $Prezzo, $pathImmagine, $tipo, $quantita = 1)
        {
            $this->IDprodotto = $IDprodotto;
            $this->Nome = $Nome;
            $this->Descrizione = $Descrizione;
            $this->Fornitore = $Fornitore;
            $this->Prezzo = $Prezzo;
            $this->pathImmagine = $pathImmagine;
            $this->tipo = $tipo;
            $this->quantita = $quantita;
        }

        // Getter per tutti gli attributi
        public function getIDprodotto()
        {
            return $this->IDprodotto;
        }

        public function getNome()
        {
            return $this->Nome;
        }

        public function getDescrizione()
        {
            return $this->Descrizione;
        }

        public function getFornitore()
        {
            return $this->Fornitore;
        }

        public function getPrezzo()
        {
            return $this->Prezzo;
        }

        public function getPathImmagine()
        {
            return $this->pathImmagine;
        }

        public function getTipo()
        {
            return $this->tipo;
        }

        public function getQuantita()
        {
            return $this->quantita;
        }

        // Metodo setter per quantita
        public function setQuantita($quantita) {
            $this->quantita = $quantita;
        }

        // Salva l'utente su file in formato CSV
        public function salvaSuFile($filePath)
        {
            $riga = "\r\n" . $this->IDprodotto . ";" . $this->Nome . ";" . $this->Descrizione . ";" . $this->Fornitore . ";" . $this->Prezzo . ";" . $this->pathImmagine . ";" . $this->tipo . ";" . $this->quantita;
            file_put_contents($filePath, $riga, FILE_APPEND);
        }

        // Funzione per caricare prodotti da file
        public static function caricaProdotti($filePath)
        {
            $contenuto = file_get_contents($filePath);
            $righe = explode("\r\n", $contenuto);
            $prodotti = [];
            foreach ($righe as $riga) {
                $campi = explode(";", $riga);
                if (count($campi) === 8) { // Aggiunto controllo per 8 campi
                    $prodotti[] = new Prodotto($campi[0], $campi[1], $campi[2], $campi[3], $campi[4], $campi[5], $campi[6], $campi[7]);
                }
            }
            return $prodotti;
        }

        // Metodo statico per cercare prodotti
        public static function cercaProdotti($prodotti, $searchTerm)
        {
            $prodottiFiltrati = [];
            foreach ($prodotti as $prodotto) {
                if (stripos($prodotto->getNome(), $searchTerm) !== false) {
                    $prodottiFiltrati[] = $prodotto;
                }
            }
            return $prodottiFiltrati;
        }

        // Metodo statico per ordinare prodotti
        public static function ordinaProdotti($prodotti)
        {
            for ($i = 0; $i < count($prodotti) - 1; $i++) {
                for ($j = 0; $j < count($prodotti) - 1 - $i; $j++) {
                    if (strcmp($prodotti[$j]->getNome(), $prodotti[$j + 1]->getNome()) > 0) {
                        $temp = $prodotti[$j];
                        $prodotti[$j] = $prodotti[$j + 1];
                        $prodotti[$j + 1] = $temp;
                    }
                }
            }
            return $prodotti;
        }

        public static function ottieniTipiUnici($prodotti)
        {
            $tipi = [];
            foreach ($prodotti as $prodotto) {
                $tipo = $prodotto->getTipo();
                // Verifica se il tipo non è già stato aggiunto
                $presente = false;
                foreach ($tipi as $t) {
                    if ($t === $tipo) {
                        $presente = true;
                        break;
                    }
                }
                // Se il tipo non è presente, lo aggiungi all'array
                if (!$presente) {
                    $tipi[] = $tipo;
                }
            }
            return $tipi;
        }
        
    }
?>
