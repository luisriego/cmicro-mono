<?php

declare(strict_types=1);

namespace App\Controller;

use App\Http\Response\ApiResponse;
use Symfony\Component\HttpFoundation\Response;

class ApiController
{
    public function createResponse(array $data, int $status = Response::HTTP_OK): ApiResponse
    {
        return new ApiResponse($data, $status);
    }
}