<?php
    class Studente {
        private $id;
        private $username;
        private $ruolo;

        public function __construct($id, $username, $ruolo) {
            $this->id = $id;
            $this->username = $username;
            $this->ruolo = $ruolo;
        }

        public function getId() {
            return $this->id;
        }

        public function getUsername() {
            return $this->username;
        }

        public function isAdmin() {
            return $this->ruolo === 'admin';
        }

        public static function login($conn, $username, $password) {
            $password_hash = md5($password);
            $query = "SELECT * FROM studenti WHERE username = '$username' AND password = '$password_hash'";
            $result = $conn->query($query);

            if ($result->num_rows > 0) {
                $user = $result->fetch_assoc();
                return new Studente($user['id'], $user['username'], $user['ruolo']);
            }
            return null;
        }
    }
?>
