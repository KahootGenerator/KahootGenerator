<?php

namespace App\Database\Managers;

use App\Core\Manager;
use App\Database\Models\difficulty;
use PDOException;

class DifficultyManager extends Manager
{
    public function __construct()
    {
        $this->setTable('difficulty');
        $this->getConnection();
    }

    public function getDifficultys(string $username): Difficulty|null
    {
        $query = $this->_connexion->query('SELECT * FROM difficulty ORDER BY libelle');
        $match = $query->fetch();
        if ($match) {
            return new Difficulty($match['id'], $match['libelle']);
        }
        return null;
    }

    public function getOne(string $id)
    {
        $sql = "SELECT * FROM difficulty WHERE id = :id";

        $query = $this->_connexion->prepare($sql);

        $query->execute(['id' => $id]);

        return $query->fetch();
    }
}