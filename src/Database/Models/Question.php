<?php

namespace App\Database\Models;

use App\Database\Managers\AnswerManager;

final class Question
{
    private string $id;
    private string $id_kahoot;
    private int $time;
    private string $question;
    private array $answers;

    public function __construct(string $id, string $id_kahoot, int $time, string $question)
    {
        $this->setId($id);
        $this->setIdKahoot($id_kahoot);
        $this->setTime($time);
        $this->setQuestion($question);
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getid_kahoot(): string
    {
        return $this->id_kahoot;
    }

    public function gettime(): int
    {
        return $this->time;
    }

    public function getQuestion(): string
    {
        return $this->question;
    }

    public function getAnswers(): array
    {
        if (isset($this->answers)) {
            return $this->answers;
        } else {
            $manager = new AnswerManager();
            $this->answers = $manager->getAnswersFormQuestion($this->id);
            return $this->answers;
        }
    }

    public function setId(string $id): void
    {
        $this->id = $id;
    }

    public function setIdKahoot(string $id_kahoot): void
    {
        $this->id_kahoot = $id_kahoot;
    }

    public function setTime(int $time): void
    {
        $this->time = $time;
    }

    public function setQuestion(string $question): void
    {
        $this->question = $question;
    }
}