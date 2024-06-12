<?php 

namespace App\Database\Models;

final class User {
    private string $id;
    private string $username;
    private string $password;

    public function __construct(string $id, string $username, string $password) {
        $this->setId($id);
        $this->setUsername($username);
        $this->setPassword($password);
    }

    public function getId(): string {
        return $this->id;
    }

    public function getUsername(): string {
        return $this->username;
    }

    public function getPassword(): string {
        return $this->password;
    }

    public function setId(string $id): void {
        $this->id = $id;
    }

    public function setUsername(string $username): void {
        $this->username = $username;
    }

    public function setPassword(string $password): void {
        $this->password = $password;
    }
}