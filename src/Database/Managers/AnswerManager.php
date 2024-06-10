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
        $query = $this->_connexion->prepare('SELECT answer.id, id_question, libelle, correct FROM answer JOIN question ON answer.id_question = question.id WHERE id_kahoot = :id');
        $query->execute(['id' => $id]);
        return $query->fetchAll(\PDO::FETCH_CLASS, "App\Database\Models\Answer");
    }
}