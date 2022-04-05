<?php

namespace Tests\app\Application\GetUsersList;

use App\Application\GetUsersList\GetUsersListService;
use App\Application\UserDataSource\UserDataSource;
use App\Domain\User;
use Exception;
use Mockery;
use PHPUnit\Framework\TestCase;

class GetUsersListServiceTest extends TestCase
{
    private GetUsersListService $getUsersListService;
    private UserDataSource $userDataSource;

    /**
     * @setUp
     */
    protected function setUp(): void
    {
        parent::setUp();

        $this->userDataSource = Mockery::mock(UserDataSource::class);

        $this->getUsersListService = new GetUsersListService($this->userDataSource);
    }

    /**
     * @test
     */
    public function callReturnsGenericError()
    {
        $this->userDataSource
            ->expects('getUsersList')
            ->once()
            ->andThrow(new Exception('Hubo un error al realizar la peticion'));

        $this->expectException(Exception::class);

        $this->getUsersListService->execute();
    }

    /**
     * @test
     */
    public function thereAreNoUsers()
    {
        $this->userDataSource
            ->expects('getUsersList')
            ->once()
            ->andReturns([]);

        $usersList = $this->getUsersListService->execute();

        $this->assertEquals([], $usersList);
    }

    /**
     * @test
     */
    public function thereAreMultipleUsers()
    {
        $this->userDataSource
            ->expects('getUsersList')
            ->once()
            ->andReturns([1,2,3]);

        $returnedUsersList = $this->getUsersListService->execute();

        $this->assertEquals([1,2,3], $returnedUsersList);
    }
}
