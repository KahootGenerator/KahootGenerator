<?php

namespace App\Database\Managers;

use App\Core\Manager;
use App\Database\Models\Kahoot;
use PDOException;

class UserManager extends Manager
{
    public function __construct()
    {
        $this->setTable('kahoot');
        $this->getConnection();
    }
}