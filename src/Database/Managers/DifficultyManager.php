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

    public function getDifficultys(): array
    {
        $query = $this->_connexion->query('SELECT * FROM difficulty ORDER BY libelle');
        return $query->fetchAll(\PDO::FETCH_CLASS, "App\Database\Models\Difficulty");
    }
}