<?php

namespace Tests\app\Infrastructure\Controller;

use App\Application\UserDataSource\UserDataSource;
use App\Domain\User;
use Exception;
use Illuminate\Http\Response;
use Mockery;
use Tests\TestCase;

class GetUsersIdsListControllerTest extends TestCase
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
        $response = $this->get('/api/users');

        $response->assertStatus(
            Response::HTTP_BAD_REQUEST
        )
            ->assertExactJson(['error' => 'Hubo un error al realizar la peticion']);
    }
}
