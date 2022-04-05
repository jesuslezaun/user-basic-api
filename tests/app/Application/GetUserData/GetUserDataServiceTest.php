<?php

namespace Tests\app\Application\GetUserData;

use App\Application\GetUserData\GetUserDataService;
use App\Application\UserDataSource\UserDataSource;
use App\Domain\User;
use Exception;
use Mockery;
use PHPUnit\Framework\TestCase;

class GetUserDataServiceTest extends TestCase
{
    private GetUserDataService $getUserDataService;
    private UserDataSource $userDataSource;

    /**
     * @setUp
     */
    protected function setUp(): void
    {
        parent::setUp();

        $this->userDataSource = Mockery::mock(UserDataSource::class);

        $this->getUserDataService = new GetUserDataService($this->userDataSource);
    }

    /**
     * @test
     */
    public function userNotFoundForGivenId()
    {
        $email = 'random_email@email.com';
        $userId = 999;

        $this->userDataSource
            ->expects('findByID')
            ->with($userId)
            ->once()
            ->andThrow(new Exception('User not found'));

        $this->expectException(Exception::class);

        $this->getUserDataService->getUserData($userId);
    }

    /**
     * @test
     */
    public function getUserDataForGivenId()
    {
        $email = 'email@email.com';
        $userId = 1;

        $user = new User($userId, $email);

        $this->userDataSource
            ->expects('findById')
            ->with($userId)
            ->once()
            ->andReturn($user);

        $getUserDataService = $this->getUserDataService->getUserData($userId);

        $this->assertEquals(1, $getUserDataService->getUserId());
        $this->assertEquals('email@email.com', $getUserDataService->getEmail());
    }
}
