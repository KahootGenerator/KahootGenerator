<?php

namespace App\Database\Models;

final class Question
{
    private string $id;
    private string $id_kahoot;
    private int $id_time;
    private string $question;
    private array $answers;

    public function __construct(string $id, string $id_kahoot, int $id_time, string $question)
    {
        $this->setId($id);
        $this->setIdKahoot($id_kahoot);
        $this->setIdTime($id_time);
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

    public function getid_time(): int
    {
        return $this->id_time;
    }

    public function getQuestion(): string
    {
        return $this->question;
    }

    public function getanswers(): array
    {
        if (isset($this->answers)) {
            return $this->answers;
        } else {
            $manager = new QuestionManager();
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

    public function setIdTime(int $id_time): void
    {
        $this->id_time = $id_time;
    }

    public function setQuestion(string $question): void
    {
        $this->question = $question;
    }
}