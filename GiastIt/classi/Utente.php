<?php
    class Utente {
        private $username;
        private $password;
        private $isPro;

        public function __construct($username, $password, $isPro) {
            $this->username = $username;
            $this->password = $password;
            $this->isPro = $isPro;
        }

        public function getUsername() {
            return $this->username;
        }

        public function getPassword() {
            return $this->password;
        }

        public function isPro() {
            return $this->isPro;
        }
    }
?>
