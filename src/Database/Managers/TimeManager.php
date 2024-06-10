<?php

namespace App\Database\Managers;

use App\Core\Manager;
use App\Database\Models\Time;
use PDOException;

class TimeManager extends Manager
{
    public function __construct()
    {
        $this->setTable('time');
        $this->getConnection();
    }

    public function getTimes(): array
    {
        $query = $this->_connexion->query('SELECT * FROM time ORDER BY seconds');
        return $query->fetchAll(\PDO::FETCH_CLASS, "App\Database\Models\Time");
    }
}