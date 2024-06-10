<?php

namespace App\Core;

use PDO;
use PDOException;

abstract class Manager
{

    private string $host = HOST;
    private string $db_name = DBNAME;
    private string $username = USERNAME;
    private string $password = PASSWORD;
    protected PDO|null $_connexion;

    public $table;

    public function getTable(): string
    {
        return $this->table;
    }

    public function setTable(string $table)
    {
        $this->table = $table;
    }

    public function getConnection(): void
    {
        $this->_connexion = null;

        try {
            $this->_connexion = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
            $this->_connexion->exec('set names utf8');
        } catch (PDOException $e) {
            echo "Erreur de connexion : " . $e->getMessage();
        }
    }

    public function getOne(string $id)
    {
        $sql = "SELECT * FROM :table WHERE id = :id";

        $query = $this->_connexion->prepare($sql);

        $query->execute(array('table' => $this->getTable(), 'id' => $id));

        return $query->fetch();
    }

    public function getAll()
    {
        $sql = "SELECT * FROM " . $this->getTable();

        return $this->_connexion->query($sql);
    }
}
?>