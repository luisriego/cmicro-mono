<?php

declare(strict_types=1);

namespace App\Tests\Functional\User;

use App\Tests\Functional\FunctionalTestBase;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class ValidateUserActionTest extends FunctionalTestBase
{
    private const ENDPOINT_CREATE = '/api/v1/users/create';
    private const ENDPOINT = '/api/v1/users/activate';

    public function testValidateUser(): void
    {
        $payload = [
            'name' => 'Juan',
            'email' => 'juan2@api.com'
        ];

        self::$baseClient->request(Request::METHOD_POST, self::ENDPOINT_CREATE, [], [], [], \json_encode($payload));
        $response = self::$baseClient->getResponse();
        $responseData = \json_decode($response->getContent(), true);
        $code = $responseData['code'];

        $payload = [
            'email' => 'juan2@api.com',
            'code' => $code,
            'password' => 'password'
        ];

        self::$baseClient->request(Request::METHOD_PUT, self::ENDPOINT, [], [], [], \json_encode($payload));

        $response = self::$baseClient->getResponse();

        self::assertEquals(Response::HTTP_OK, $response->getStatusCode());
        $responseData = \json_decode($response->getContent(), true);
        self::assertEquals(null, $responseData['code']);
        self::assertEquals(true, $responseData['isActive']);
    }

    public function testValidateUserFailWithInvalidToken(): void
    {
        $tokenInvalid = 'c55a1f1f9e18fbaeabd98c70c450d6828995a317';

        $payload = [
            'email' => 'juan@api.com',
            'code' => $tokenInvalid,
            'password' => 'password'
        ];

        self::$baseClient->request(Request::METHOD_PUT, self::ENDPOINT, [], [], [], \json_encode($payload));

        $response = self::$baseClient->getResponse();

        self::assertEquals(JsonResponse::HTTP_NOT_FOUND, $response->getStatusCode());
    }
}