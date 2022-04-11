<?php

namespace Tests\app\Infrastructure\Controller;

use App\Application\UserDataSource\UserDataSource;
use App\Domain\User;
use Exception;
use Illuminate\Http\Response;
use Mockery;
use Tests\TestCase;

class GetUsersListControllerTest extends TestCase
{
    private UserDataSource $userDataSource;

    /**
     * @setUp
     */
    protected function setUp(): void
    {
        parent::setUp();

        $this->userDataSource = Mockery::mock(UserDataSource::class);
        $this->app->bind(UserDataSource::class, fn () => $this->userDataSource);
    }

    /**
     * @test
     */
    public function petitionGeneratesGenericError()
    {
        $this->userDataSource
            ->expects('getUsersList')
            ->once()
            ->andThrow(new Exception('Hubo un error al realizar la peticion'));

        $response = $this->get('/api/users/list');

        $response->assertStatus(
            Response::HTTP_BAD_REQUEST
        )
            ->assertExactJson(['error' => 'Hubo un error al realizar la peticion']);
    }

    /**
     * @test
     */
    public function thereAreNoUsers()
    {
        $this->userDataSource
            ->expects('getUsersList')
            ->once()
            ->andReturn([]);

        $response = $this->get('/api/users/list');

        $response->assertStatus(Response::HTTP_OK)->assertExactJson([]);
    }

    /**
     * @test
     */
    public function thereAreMultipleUsers()
    {
        $this->userDataSource
            ->expects('getUsersList')
            ->once()
            ->andReturn([1,2,3]);

        $response = $this->get('/api/users/list');

        $response->assertStatus(Response::HTTP_OK)->assertExactJson([['id' => 1],['id' => 2],['id' => 3]]);
    }
}
