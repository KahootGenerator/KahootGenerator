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
        $sql = "SELECT kahoot.id as id, id_user, difficulty.libelle as difficulty, language.libelle as language, title, theme, date FROM kahoot JOIN difficulty ON kahoot.id_difficulty = difficulty.id JOIN language ON kahoot.id_language = language.id WHERE kahoot.id = :id";

        $query = $this->_connexion->prepare($sql);

        $query->execute(['id' => $id]);

        $match = $query->fetch();
        if($match) {
            return new Kahoot($match['id'], $match['id_user'], $match['difficulty'], $match['language'], $match['title'], $match['theme'], $match['date']);
        }
        return $query->fetch();
    }

    public function getFromUser(string $id): array {
        $query = $this->_connexion->prepare('SELECT kahoot.id as id, id_user, difficulty.libelle as difficulty, language.libelle as language, title, theme, date FROM kahoot JOIN difficulty ON kahoot.id_difficulty = difficulty.id JOIN language ON kahoot.id_language = language.id WHERE id_user = ?');
        $query->execute([
            $id
        ]);
        $kahoots = [];
        while($match = $query->fetch()) {
            $kahoots[] = new Kahoot($match['id'], $match['id_user'], $match['difficulty'], $match['language'], $match['title'], $match['theme'], $match['date']);
        }
        return $kahoots;
    }
}