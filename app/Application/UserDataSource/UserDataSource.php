<?php

namespace App\Application\UserDataSource;

use App\Domain\User;

interface UserDataSource
{
    public function findByEmail(string $email): User;

    public function findByID(int $userId): User;

    public function getUsersList(): array;
}
