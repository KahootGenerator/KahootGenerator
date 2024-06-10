<?php

namespace App\Database\Managers;

use App\Core\Manager;
use App\Database\Models\Question;
use PDOException;

class QuestionManager extends Manager
{
    public function __construct()
    {
        $this->setTable('question');
        $this->getConnection();
    }

    public function getQuestionsFormKahoot(string $id): array
    {
        $query = $this->_connexion->prepare('SELECT id, id_kahoot, id_time, question FROM question WHERE id_kahoot = :id');
        $query->execute(['id' => $id]);
        $questions = [];
        while ($match = $query->fetch()) {
            $questions[] =  new Question($match["id"], $match["id_kahoot"], $match["id_time"], $match["question"]);
        }
        return $questions;
    }

    public function create(string $id, string $id_kahoot, string $question): void {
        $query = $this->_connexion->prepare('INSERT INTO question (id, id_kahoot, id_time, question) VALUES (?,?,4,?)');
        $query->execute([
            $id,
            $id_kahoot,
            $question
        ]);
    }
}