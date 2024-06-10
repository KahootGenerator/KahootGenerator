<?php

namespace App\Database\Managers;

use App\Core\Manager;
use App\Database\Models\Difficulty;
use PDOException;

class DifficultyManager extends Manager
{
    public function __construct()
    {
        $this->setTable('difficulty');
        $this->getConnection();
    }

    public function getDifficulties(): array
    {
        $query = $this->_connexion->query('SELECT * FROM difficulty ORDER BY libelle');
        $difficulties = [];
        while ($match = $query->fetch()) {
            $difficulties[] = new Difficulty($match['id'], $match['libelle']);
        }
        return $difficulties;
    }

    public function getOne(string $id)
    {
        $sql = "SELECT * FROM difficulty WHERE id = :id";

        $query = $this->_connexion->prepare($sql);

        $query->execute(['id' => $id]);

        return $query->fetch();
    }
}