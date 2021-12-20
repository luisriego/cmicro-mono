<?php

declare(strict_types=1);

namespace App\Tests\Functional\Client;

use App\Tests\Functional\FunctionalTestBase;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class DeleteClientActionTest extends FunctionalTestBase
{
    private const ENDPOINT = '/api/v1/clients';

    public function testDeleteClient(): void
    {
        self::$authenticatedClient->request(
            Request::METHOD_DELETE,
            \sprintf('%s/%s', self::ENDPOINT, $this->getEngelocId())
        );

        $response = self::$authenticatedClient->getResponse();
        $responseData = \json_decode($response->getContent(), true);

        self::assertEquals(Response::HTTP_NO_CONTENT, $response->getStatusCode());
    }
}