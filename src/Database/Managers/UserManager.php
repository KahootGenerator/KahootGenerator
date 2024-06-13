<?php

namespace App\Database\Managers;

use App\Core\Manager;
use App\Database\Models\User;
use PDOException;

class UserManager extends Manager
{
    public function __construct()
    {
        $this->setTable('user');
        $this->getConnection();
    }

    public function find(string $username): User|null
    {
        $query = $this->_connexion->prepare('SELECT * FROM user WHERE username = :username');
        $query->execute(['username' => $username]);
        $match = $query->fetch();
        if ($match) {
            return new User($match['id'], $match['username'], $match['password']);
        }
        return null;
    }

    public function create(string $id, string $username, string $password): bool|PDOException
    {
        $query = $this->_connexion->prepare('INSERT INTO user (id, username, password) VALUES (:id, :username, :password)');

        try {
            $query->execute([
                // 'table' => $this->getTable(),
                'id' => $id,
                'username' => $username,
                'password' => $password,
            ]);

            return true;
        } catch (PDOException $e) {
            throw $e;
        }
    }

    public function delete(string $id): void {
        $query = $this->_connexion->prepare('DELETE FROM user WHERE id = ?');
        $query->execute([
            $id
        ]);
    }
}