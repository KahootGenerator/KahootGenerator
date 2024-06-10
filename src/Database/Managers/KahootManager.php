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

    public function getOne(string $id)
    {
        $sql = "SELECT * FROM kahoot WHERE id = :id";

        $query = $this->_connexion->prepare($sql);

        $query->execute(['id' => $id]);

        $match = $query->fetch();
        if($match) {
            return new Kahoot($match['id'], $match['id_user'], $match['id_difficulty'], $match['id_language'], $match['title'], $match['theme'], $match['date']);
        }
        return $query->fetch();
    }
}