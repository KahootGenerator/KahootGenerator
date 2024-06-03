<?php

namespace App\Database;

use PDO;
use PDOException;

final class Creator
{
    protected PDO|null $_connection;

    public function __construct()
    {
        try {
            $this->_connection = new PDO("mysql:host=" . HOST, USERNAME, PASSWORD);
            $this->_connection->exec('set names utf8');
        } catch (PDOException $e) {
            echo "Erreur de connexion : " . $e->getMessage();
        }
    }

    public function checkDatabase(): void
    {
        $sql = "SELECT SCHEMA_NAME FROM INFORMATION_SCHEMA.SCHEMATA WHERE SCHEMA_NAME = :db;";

        $query = $this->_connection->prepare($sql);

        $query->execute(['db' => DBNAME]);

        if (!$query->fetch()) {
            $this->createDatabase();
        }
    }

    protected function createDatabase(): void
    {
        if ($sql = file_get_contents("../project/db/" . DBNAME . ".sql")) {
            $this->_connection->exec($sql);
        }
    }
}
