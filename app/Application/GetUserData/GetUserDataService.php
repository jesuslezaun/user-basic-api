<?php

namespace App\Application\GetUserData;

use App\Application\UserDataSource\UserDataSource;
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
     * @return array
     * @throws Exception
     */
    public function getUserData(int $userId): array
    {
        $user = $this->userDataSource->findByID($userId);
    }
}
