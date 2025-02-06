<?php
    class Utente
    {
        private $username;
        private $password;
        private $role;
        private $nome;
        private $cognome;
        private $mail;
        private $CAP;
        private $indirizzo;


        public function __construct($username, $password, $role, $nome, $cognome, $mail, $CAP, $indirizzo)
        {
            $this->username = $username;
            $this->password = $password;
            $this->role = $role;
            $this->nome = $nome;
            $this->cognome = $cognome;
            $this->mail = $mail;
            $this->CAP = $CAP;
            $this->indirizzo = $indirizzo;
        }

        // Salva l'utente su file in formato CSV
        public function salvaSuFile($filePath)
        {
            $riga = "\r\n" . $this->username . ";" . $this->password . ";" . $this->role . ";" . $this->nome . ";" . $this->cognome . ";" . $this->mail . ";" . $this->CAP . ";" . $this->indirizzo;
            file_put_contents($filePath, $riga, FILE_APPEND);
        }

        // Funzione per caricare utenti da file
        public static function caricaUtenti($filePath)
        {
            $contenuto = file_get_contents($filePath);
            $righe = explode("\r\n", trim($contenuto));
            $utenti = [];
            foreach ($righe as $riga) {
                $campi = explode(";", $riga);
                if (count($campi) === 8) {
                    $utenti[] = new Utente($campi[0], $campi[1], $campi[2], $campi[3], $campi[4], $campi[5], $campi[6], $campi[7]);
                }
            }
            return $utenti;
        }

        // Getter per gli attributi
        public function getUsername()
        {
            return $this->username;
        }

        public function getPassword()
        {
            return $this->password;
        }

        public function getRole()
        {
            return $this->role;
        }

        public function getNome()
        {
            return $this->nome;
        }

        public function getCognome()
        {
            return $this->cognome;
        }

        public function getMail()
        {
            return $this->mail;
        }

        public function getCAP()
        {
            return $this->CAP;
        }

        public function getIndirizzo()
        {
            return $this->indirizzo;
        }
    }
?>