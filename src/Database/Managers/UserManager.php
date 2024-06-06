<?php

namespace App\Database\Managers;

use App\Core\Manager;
use App\Database\Models\User;
use PDOException;

class UserManager extends Manager
{
    public function __construct() {
        $this->setTable('user');
        $this->getConnection();
    }

    public function find(string $id): User | null {
        $match = $this->getOne($id);

        if ($match) {
            return new User($match['id'], $match['username'], $match['password']);
        }

        return null;
    }

    public function create(string $id, string $username, string $password): bool | PDOException {
        $query = $this->_connexion->prepare('INSERT INTO :table (id, username, password) VALUES (:id, :username, :password)');

        try {
            $query->execute([
                'table' => $this->getTable(),
                'id' => $id,
                'username' => $username,
                'password' => $password,
            ]);

            return true;
        } catch(PDOException $e) {
            return false;
        }
    }
}