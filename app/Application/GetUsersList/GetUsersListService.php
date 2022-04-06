<?php

namespace App\Application\GetUsersList;

use App\Application\UserDataSource\UserDataSource;
use Exception;

class GetUsersListService
{
    /**
     * @var UserDataSource
     */
    private UserDataSource $userDataSource;

    /**
     * IsEarlyAdopterService constructor.
     * @param UserDataSource $userDataSource
     */
    public function __construct(UserDataSource $userDataSource)
    {
        $this->userDataSource = $userDataSource;
    }

    /**
     * @return array
     * @throws Exception
     */
    public function execute(): array
    {
        return $this->userDataSource->getUsersList();
    }
}
