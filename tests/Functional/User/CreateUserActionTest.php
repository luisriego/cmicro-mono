<?php

declare(strict_types=1);

namespace App\Tests\Functional\User;

use App\Entity\Client;
use App\Tests\Functional\FunctionalTestBase;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class CreateUserActionTest extends FunctionalTestBase
{
    private const ENDPOINT = '/api/v1/users/create';

    public function testCreateUser(): void
    {

        $payload = [
            'name' => 'Juan',
            'email' => 'juan@api.com',
            'client' => '00000000000000'
        ];

        self::$baseClient->request(Request::METHOD_POST, self::ENDPOINT, [], [], [], \json_encode($payload));

        $response = self::$baseClient->getResponse();

        self::assertEquals(JsonResponse::HTTP_CREATED, $response->getStatusCode());
        $responseData = \json_decode($response->getContent(), true);
        self::assertArrayHasKey('fullName', $responseData);
        self::assertArrayHasKey('email', $responseData);
    }

    public function testCreateUserMustHaveAConstrainConflict(): void
    {
        $payload = [
            'name' => 'Juan',
            'email' => 'juan@api.com',
            'client' => '00000000000000'
        ];

        self::$baseClient->request(Request::METHOD_POST, self::ENDPOINT, [], [], [], \json_encode($payload));

        $response = self::$baseClient->getResponse();

        self::assertEquals(JsonResponse::HTTP_CONFLICT, $response->getStatusCode());

    }

     public function testCreateUserWithNoName(): void
     {
         $payload = [
             'email' => 'juan@api.com',
             'client' => '00000000000000'
         ];

         self::$baseClient->request(Request::METHOD_POST, self::ENDPOINT, [], [], [], \json_encode($payload));

         $response = self::$baseClient->getResponse();

         self::assertEquals(JsonResponse::HTTP_BAD_REQUEST, $response->getStatusCode());
     }

     public function testCreateUserWithNoEmail(): void
     {
         $payload = [
             'name' => 'Juan',
             'client' => '00000000000000'
         ];

         self::$baseClient->request(Request::METHOD_POST, self::ENDPOINT, [], [], [], \json_encode($payload));

         $response = self::$baseClient->getResponse();

         self::assertEquals(JsonResponse::HTTP_BAD_REQUEST, $response->getStatusCode());
     }

     public function testCreateUserWithInvalidName(): void
     {
         $payload = [
             'name' => 'a',
             'email' => 'juan@api.com',
             'client' => '00000000000000'
         ];

         self::$baseClient->request(Request::METHOD_POST, self::ENDPOINT, [], [], [], \json_encode($payload));

         $response = self::$baseClient->getResponse();

         self::assertEquals(JsonResponse::HTTP_BAD_REQUEST, $response->getStatusCode());
     }

     public function testCreateUserWithInvalidEmail(): void
     {
         $payload = [
             'name' => 'Juan',
             'email' => 'api.com',
             'client' => '00000000000000'
         ];

         self::$baseClient->request(Request::METHOD_POST, self::ENDPOINT, [], [], [], \json_encode($payload));

         $response = self::$baseClient->getResponse();

         self::assertEquals(JsonResponse::HTTP_BAD_REQUEST, $response->getStatusCode());
     }
}