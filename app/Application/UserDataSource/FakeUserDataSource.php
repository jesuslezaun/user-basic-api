<?php

namespace App\Application\UserDataSource;

use App\Domain\User;
use Exception;

class FakeUserDataSource implements UserDataSource
{
    public function findByEmail(string $email): User
    {
        // TODO: Implement findByEmail() method.
    }

    public function findByID(int $userId): User
    {
        if ($userId == 1) {
            return new User(1, "user@user.com");
        } elseif ($userId == 999) {
            throw new Exception("Usuario no encontrado");
        } else {
            throw new Exception("Hubo un error al realizar la peticion");
        }
    }

    public function getUsersList(): array
    {
        $randomNumber = random_int(1, 3);
        if ($randomNumber == 1) {
            return [];
        } elseif ($randomNumber == 2) {
            return [1,2,3];
        } else {
            throw new Exception("Hubo un error al realizar la peticion");
        }
    }
}
