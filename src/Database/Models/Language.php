<?php

namespace App\Database\Models;

final class Language
{
    private int $id;
    private string $libelle;

    public function __construct(int $id, string $libelle)
    {
        $this->setId($id);
        $this->setlibelle($libelle);
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getlibelle(): string
    {
        return $this->libelle;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function setlibelle(string $libelle): void
    {
        $this->libelle = $libelle;
    }
}