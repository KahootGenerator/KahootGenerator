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
        $query = $this->_connexion->prepare('SELECT question.id, id_kahoot, id_time, question FROM question JOIN kahoot ON question.id_kahoot = kahoot.id WHERE id_kahoot = :id');
        $query->execute(['id' => $id]);
        return $query->fetchAll(\PDO::FETCH_CLASS, "App\Database\Models\Question");
    }
}