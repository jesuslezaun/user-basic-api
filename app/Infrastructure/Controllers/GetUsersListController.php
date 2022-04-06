<?php

namespace App\Infrastructure\Controllers;

use App\Application\GetUsersList\GetUsersListService;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller as BaseController;

class GetUsersListController extends BaseController
{
    private GetUsersListService $getUsersListService;

    /**
     * GetUsersListController constructor.
     */
    public function __construct(GetUsersListService $getUsersListService)
    {
        $this->getUsersListService = $getUsersListService;
    }

    public function __invoke(): JsonResponse
    {
        try {
            $usersList = $this->getUsersListService->execute();
        } catch (Exception $exception) {
            return response()->json([
                'error' => $exception->getMessage()
            ], Response::HTTP_BAD_REQUEST);
        }

        $jsonData = [];
        foreach ($usersList as $user) {
            $jsonData[] = ['id' => $user];
        }

        return response()->json($jsonData, Response::HTTP_OK);
    }
}
