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
        $times = [];
        while ($match = $query->fetch()) {
            $times[] = new Time($match['id'], $match['seconds']);
        }
        return $times;
    }
}