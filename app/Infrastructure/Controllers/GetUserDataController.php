<?php

namespace App\Infrastructure\Controllers;

use App\Application\EarlyAdopter\IsEarlyAdopterService;
use App\Application\GetUserData\GetUserDataService;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller as BaseController;

use function PHPUnit\Framework\isNull;

class GetUserDataController extends BaseController
{
    private $getUserDataService;

    /**
     * GetUserDataController constructor.
     */
    public function __construct(GetUserDataService $getUserDataService)
    {
        $this->getUserDataService = $getUserDataService;
    }

    public function __invoke(int $userId = null): JsonResponse
    {
        if ($userId == null) {
            return response()->json([
                'error' => 'User ID missing on petition'
            ], Response::HTTP_BAD_REQUEST);
        }

        try {
            $getUserDataService = $this->getUserDataService->getUserData($userId);
        } catch (Exception $exception) {
            return response()->json([
                'error' => $exception->getMessage()
            ], Response::HTTP_BAD_REQUEST);
        }

        return response()->json([
            'id' => $getUserDataService->getUserId(),
            'email' => $getUserDataService->getEmail()
        ], Response::HTTP_OK);
    }
}
