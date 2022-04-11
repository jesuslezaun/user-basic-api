<?php

namespace App\Domain;

use PhpParser\Node\Scalar\String_;

class User
{
    private int $userId;
    private string $email;

    public function __construct(int $userId, string $email)
    {
        $this->userId = $userId;
        $this->email = $email;
    }

    public function getUserId(): int
    {
        return $this->userId;
    }
    public function getEmail(): string
    {
        return $this->email;
    }
}
