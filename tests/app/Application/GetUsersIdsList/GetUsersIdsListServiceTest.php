<?php

namespace Tests\app\Application\GetUsersIdsList;

use App\Application\GetUsersIdsList\GetUsersIdsListService;
use App\Application\UserDataSource\UserDataSource;
use Exception;
use Mockery;
use PHPUnit\Framework\TestCase;

class GetUsersIdsListServiceTest extends TestCase
{
    private GetUsersIdsListService $getIdsListService;
    private UserDataSource $userDataSource;

    /**
     * @setUp
     */
    protected function setUp(): void
    {
        parent::setUp();

        $this->userDataSource = Mockery::mock(UserDataSource::class);

        $this->getIdsListService = new GetUsersIdsListService($this->userDataSource);
    }

    /**
     * @test
     */
    public function callReturnsGenericError()
    {
        $this->userDataSource
            ->expects('getUsersIdsList')
            ->once()
            ->andThrow(new Exception('Hubo un error al realizar la peticion'));

        $this->expectException(Exception::class);

        $this->getIdsListService->execute();
    }

    /**
     * @test
     */
    public function thereAreNoUsers()
    {
        $this->userDataSource
            ->expects('getUsersIdsList')
            ->once()
            ->andReturns([]);

        $usersIdsList = $this->getIdsListService->execute();

        $this->assertEquals([], $usersIdsList);
    }
}
