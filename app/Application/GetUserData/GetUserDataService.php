<?php

namespace App\Application\GetUserData;

use App\Application\UserDataSource\UserDataSource;
use App\Domain\User;
use Exception;

class GetUserDataService
{
    /**
     * @var UserDataSource
     */
    private $userDataSource;

    /**
     * GetUserDataService constructor.
     * @param UserDataSource $userDataSource
     */
    public function __construct(UserDataSource $userDataSource)
    {
        $this->userDataSource = $userDataSource;
    }

    /**
     * @param int $userId
     * @return \App\Domain\User
     * @throws Exception
     */
    public function getUserData(int $userId): User
    {
        return $this->userDataSource->findByID($userId);
    }
}
