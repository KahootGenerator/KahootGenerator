<?php

namespace App\Database\Managers;

use App\Core\Manager;
use App\Database\Models\Language;
use PDOException;

class LanguageManager extends Manager
{
    public function __construct()
    {
        $this->setTable('language');
        $this->getConnection();
    }

    public function getLanguages(): array
    {
        $query = $this->_connexion->query('SELECT * FROM language ORDER BY libelle');
        $languages = [];
        while ($match = $query->fetch()) {
            $languages[] = new Language($match['id'], $match['libelle']);
        }
        return $languages;
    }

    public function find(int $id)
    {
        $sql = "SELECT * FROM language WHERE id = :id";

        $query = $this->_connexion->prepare($sql);

        $query->execute(['id' => $id]);

        $match = $query->fetch();
        if ($match) {
            return new Language($match['id'], $match['libelle']);
        }
        return null;
    }
}