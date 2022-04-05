<?php

namespace App\Infrastructure\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller as BaseController;

class GetUsersIdsListController extends BaseController
{
    /**
     * GetUsersIdsListController constructor.
     */
    public function __construct()
    {
    }

    public function __invoke(): JsonResponse
    {
        return response()->json([
            'error' => 'Hubo un error al realizar la peticion'
        ], Response::HTTP_BAD_REQUEST);
    }
}
