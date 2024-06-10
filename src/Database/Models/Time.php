<?php

namespace App\Database\Models;

final class Time
{
    private int $id;
    private int $seconds;

    public function __construct(int $id, int $seconds)
    {
        $this->setId($id);
        $this->setSeconds($seconds);
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getSeconds(): int
    {
        return $this->seconds;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function setSeconds(int $seconds): void
    {
        $this->seconds = $seconds;
    }
}