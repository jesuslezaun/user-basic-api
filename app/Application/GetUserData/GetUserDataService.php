<?php

namespace App\Application\GetUserData;

use App\Application\UserDataSource\UserDataSource;
use Exception;
use http\Client\Curl\User;

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
    public function getUserData(int $userId): \App\Domain\User
    {
        $user = $this->userDataSource->findByID($userId);
        return $user;
    }
}
