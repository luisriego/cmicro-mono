<?php

declare(strict_types=1);

namespace App\Tests\Functional\Client;

use App\Tests\Functional\FunctionalTestBase;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

class GetClientByIdActionTest extends FunctionalTestBase
{
    private const ENDPOINT = '/api/v1/clients';

    public function testGetClientById(): void
    {
        self::$authenticatedClient->request(Request::METHOD_GET, \sprintf('%s/%s', self::ENDPOINT, $this->getEngelocId()));

        $response = self::$authenticatedClient->getResponse();

        self::assertEquals(Response::HTTP_OK, $response->getStatusCode());

        $responseData = \json_decode($response->getContent(), true);
        self::assertArrayHasKey('id', $responseData);
        self::assertArrayHasKey('companyName', $responseData);
        self::assertArrayHasKey('cnpj', $responseData);
        self::assertArrayHasKey('xRays', $responseData);
        self::assertArrayHasKey('createdOn', $responseData);
    }
}