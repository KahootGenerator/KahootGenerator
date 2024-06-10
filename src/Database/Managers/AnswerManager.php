<?php

namespace App\Database\Managers;

use App\Core\Manager;
use App\Database\Models\Answer;
use PDOException;

class AnswerManager extends Manager
{
    public function __construct()
    {
        $this->setTable('answer');
        $this->getConnection();
    }

    public function getAnswersFormQuestion(string $id): array
    {
        $query = $this->_connexion->prepare('SELECT id, id_question, libelle, correct FROM answer WHERE id_question = :id ORDER BY libelle');
        $query->execute(['id' => $id]);
        $answers = [];
        while ($match = $query->fetch()) {
            $answers[] =  new Answer($match["id"], $match["id_question"], $match["libelle"], $match["correct"]);
        }
        return $answers;
    }

    public function create(string $id, string $id_question, string $libelle, bool $correct): void {
        $query = $this->_connexion->prepare('INSERT INTO answer (id, id_question, libelle, correct) VALUES (?,?,?,?)');
        $query->execute([
            $id,
            $id_question,
            $libelle,
            $correct
        ]);
    }
}