<?php

declare(strict_types=1);

namespace App\Tests\Functional\Client;

use App\Tests\Functional\FunctionalTestBase;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class UpdateClientActionTest extends FunctionalTestBase
{
    private const ENDPOINT = '/api/v1/clients';

    public function testUpdateClientXrays(): void
    {
        $payload = [
            'xRays' => 'Locação de escadas e coisas afins a gogó'
        ];

        self::$authenticatedClient->request(
            Request::METHOD_PUT,
            \sprintf('%s/%s', self::ENDPOINT, $this->getEngelocId()),
            [], [], [],
            \json_encode($payload)
        );

        $response = self::$authenticatedClient->getResponse();
        $responseData = \json_decode($response->getContent(), true);

        self::assertEquals(Response::HTTP_OK, $response->getStatusCode());
        self::assertEquals('Locação de escadas e coisas afins a gogó', $responseData['xRays']);
    }

    public function testUpdateClientCompanyName(): void
    {
        $payload = [
            'companyName' => 'Engeloc Empreendimentos'
        ];

        self::$authenticatedClient->request(
            Request::METHOD_PUT,
            \sprintf('%s/%s', self::ENDPOINT, $this->getEngelocId()),
            [], [], [],
            \json_encode($payload)
        );

        $response = self::$authenticatedClient->getResponse();
        $responseData = \json_decode($response->getContent(), true);

        self::assertEquals(Response::HTTP_OK, $response->getStatusCode());
        self::assertEquals('Engeloc Empreendimentos', $responseData['companyName']);
    }

    public function testUpdateClient(): void
    {
        $payload = [
            'companyName' => 'Engeloc Empreendimentos Ltda.',
            'xRays' => 'Locação de escadas e coisas afins'
        ];

        self::$authenticatedClient->request(
            Request::METHOD_PUT,
            \sprintf('%s/%s', self::ENDPOINT, $this->getEngelocId()),
            [], [], [],
            \json_encode($payload)
        );

        $response = self::$authenticatedClient->getResponse();
        $responseData = \json_decode($response->getContent(), true);

        self::assertEquals(Response::HTTP_OK, $response->getStatusCode());
        self::assertEquals('Engeloc Empreendimentos Ltda.', $responseData['companyName']);
        self::assertEquals('Locação de escadas e coisas afins', $responseData['xRays']);
    }
}