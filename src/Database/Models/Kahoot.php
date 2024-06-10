<?php

namespace App\Database\Models;

use App\Database\Managers\KahootManager;
use App\Database\Managers\QuestionManager;

final class Kahoot
{
    private string $id;
    private string $id_user;
    private int $id_difficulty;
    private int $id_language;
    private string $title;
    private string $theme;
    private string $date;
    private array $questions;

    public function __construct(string $id, string $id_user, int $id_difficulty, string $id_language, string $title, string $theme, string $date)
    {
        $this->setId($id);
        $this->setIdUser($id_user);
        $this->setIdDifficulty($id_difficulty);
        $this->setIdLanguage($id_language);
        $this->setTitle($title);
        $this->setTheme($theme);
        $this->setDate($date);
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getIdUser(): string
    {
        return $this->id_user;
    }

    public function getIdDifficulty(): int
    {
        return $this->id_difficulty;
    }

    public function getIdLanguage(): int
    {
        return $this->id_language;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getTheme(): string
    {
        return $this->theme;
    }

    public function getDate(): string
    {
        return $this->date;
    }

    public function getQuestions(): array
    {
        if (isset($this->questions)) {
            return $this->questions;
        } else {
            $manager = new QuestionManager();
            $this->questions = $manager->getQuestionsFormKahoot($this->id);
            return $this->questions;
        }
    }

    public function setId(string $id): void
    {
        $this->id = $id;
    }

    public function setIdUser(string $id_user): void
    {
        $this->id_user = $id_user;
    }

    public function setIdDifficulty(int $id_difficulty): void
    {
        $this->id_difficulty = $id_difficulty;
    }

    public function setIdLanguage(int $id_language): void
    {
        $this->id_language = $id_language;
    }

    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    public function setTheme(string $theme): void
    {
        $this->theme = $theme;
    }

    public function setDate(string $date): void
    {
        $this->date = $date;
    }
}