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
        $query = $this->_connexion->prepare('SELECT question.id, id_kahoot, time.seconds as time, question FROM question JOIN time ON question.id_time = time.id WHERE id_kahoot = :id');
        $query->execute(['id' => $id]);
        $questions = [];
        while ($match = $query->fetch()) {
            $questions[] = new Question($match["id"], $match["id_kahoot"], $match["time"], $match["question"]);
        }
        return $questions;
    }

    public function create(string $id, string $id_kahoot, string $question): void
    {
        $query = $this->_connexion->prepare('INSERT INTO question (id, id_kahoot, id_time, question) VALUES (?,?,4,?)');
        $query->execute([
            $id,
            $id_kahoot,
            $question
        ]);
    }

    public function delete(string $id): void {
        $query = $this->_connexion->prepare('DELETE FROM question WHERE id = ?');
        $query->execute([
            $id
        ]);
    }
}