<?php

namespace App\Database\Models;

final class User
{
    private string $id;
    private string $id_question;
    private string $libelle;
    private bool $correct;

    public function __construct(string $id, string $id_question, string $libelle, bool $correct)
    {
        $this->setId($id);
        $this->setIdQuestion($id_question);
        $this->setlibelle($libelle);
        $this->setCorrect($correct);
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getIdQuestion(): string
    {
        return $this->id_question;
    }

    public function getlibelle(): string
    {
        return $this->libelle;
    }

    public function getCorrect(): bool
    {
        return $this->correct;
    }

    public function setId(string $id): void
    {
        $this->id = $id;
    }

    public function setIdQuestion(string $id_question): void
    {
        $this->id_question = $id_question;
    }

    public function setlibelle(string $libelle): void
    {
        $this->libelle = $libelle;
    }

    public function setCorrect(bool $correct): void
    {
        $this->correct = $correct;
    }
}