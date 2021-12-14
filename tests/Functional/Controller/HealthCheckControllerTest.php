<?php

declare(strict_types=1);

namespace App\Tests\Functional\Controller;

use App\Tests\Functional\FunctionalTestBase;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class HealthCheckControllerTest extends FunctionalTestBase
{
    private const ENDPOINT = '/api/v1/health-check';

    public function testHealthCheck(): void
    {
        self::$baseClient->request(Request::METHOD_GET, self::ENDPOINT);

        $response = self::$baseClient->getResponse();

        self::assertEquals(Response::HTTP_OK, $response->getStatusCode());
    }
}