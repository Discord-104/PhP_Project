<?php
    require_once ('Utente.php');

    class GestoreUtenti {
        private $utenti;

        public function __construct($utenti) {
            $this->utenti = $utenti;
        }

        public function verificaCredenziali($username, $password) {
            foreach ($this->utenti as $utente) {
                if ($utente->getUsername() === $username && $utente->getPassword() === $password) {
                    return $utente;
                }
            }
            return null;
        }
    }
?>
