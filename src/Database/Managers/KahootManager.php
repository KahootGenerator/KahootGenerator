<?php

namespace App\Database\Managers;

use App\Core\Manager;
use App\Database\Models\Kahoot;
use PDOException;

class KahootManager extends Manager
{
    public function __construct()
    {
        $this->setTable('kahoot');
        $this->getConnection();
    }

    public function create(string $id, int $diff, int $lang, string $title): void {
        $query = $this->_connexion->prepare("INSERT INTO kahoot (id, id_user, id_difficulty, id_language, title, theme, date) VALUES (?,?,?,?,?,?,?)");
        $query->execute([
            $id,
            $_SESSION["user"]['id'],
            $diff,
            $lang,
            $title,
            $_POST['theme'],
            date('Y-m-d')
        ]);
    }
}