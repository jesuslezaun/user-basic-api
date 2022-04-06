<?php

namespace App\Infrastructure\Controllers;

use App\Application\GetUsersIdsList\GetUsersIdsListService;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller as BaseController;

class GetUsersIdsListController extends BaseController
{
    private GetUsersIdsListService $getIdsListService;

    /**
     * GetUsersIdsListController constructor.
     */
    public function __construct(GetUsersIdsListService $getIdsListService)
    {
        $this->getIdsListService = $getIdsListService;
    }

    public function __invoke(): JsonResponse
    {
        try {
            $this->getIdsListService->execute();
        } catch (Exception $exception) {
            return response()->json([
                'error' => $exception->getMessage()
            ], Response::HTTP_BAD_REQUEST);
        }

        return response()->json([], Response::HTTP_OK);
    }
}
