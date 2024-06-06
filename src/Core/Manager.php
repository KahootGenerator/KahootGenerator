<?php

namespace App\Core;

    use PDO;
    use PDOException;

    abstract class Manager {

        private string $host = '127.0.0.1';
        private string $db_name =  '';
        private string $username = 'root';
        private string $password = '';
       protected PDO | null $_connexion;

        public $table;
        public $id;

        public function getTable(): string {
            return $this->table;
        }

        public function setTable(string $table) {
            $this->table = $table;
        }

        public function getConnection(): void {
            $this->_connexion = null;

            try {
                $this->_connexion = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
                $this->_connexion->exec('set names utf8');
            } catch(PDOException $e) {
                echo "Erreur de connexion : " . $e->getMessage();
            }
        }

        public function getOne() {
            $sql = "SELECT * FROM :table WHERE id = :id";

            $query = $this->_connexion->prepare($sql);

            $query->execute(array('table' => $this->getTable(), 'id' => $this->id));

            return $query->fetch();
        }

        public function getAll() {
            $sql = "SELECT * FROM ".$this->getTable();

            return $this->_connexion->query($sql);
        }
    }
?>