<?php

declare(strict_types=1);

namespace App\Tests\Functional\Client;

use App\Tests\Functional\FunctionalTestBase;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class GetClientsActionTest extends FunctionalTestBase
{
    private const ENDPOINT = '/api/v1/clients';

    public function testGetAllUsers(): void
    {
        self::$authenticatedClient->request(Request::METHOD_GET, \sprintf('%s', self::ENDPOINT));

        $response = self::$authenticatedClient->getResponse();

        self::assertEquals(Response::HTTP_OK, $response->getStatusCode());

        $responseData = \json_decode($response->getContent(), true);
        self::assertCount(2, $responseData['clients']);
    }

    public function testGetAllClientsFailBecauseNotEmployee(): void
    {
        self::$anotherAuthenticatedClient->request(Request::METHOD_GET, \sprintf('%s', self::ENDPOINT));

        $response = self::$anotherAuthenticatedClient->getResponse();

        self::assertEquals(Response::HTTP_FORBIDDEN, $response->getStatusCode());
    }

    public function testGetAllClientsFailBecauseUnauthorize(): void
    {
        self::$baseClient->request(Request::METHOD_GET, \sprintf('%s', self::ENDPOINT));

        $response = self::$baseClient->getResponse();

        self::assertEquals(Response::HTTP_INTERNAL_SERVER_ERROR, $response->getStatusCode());
    }
}