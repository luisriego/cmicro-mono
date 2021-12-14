<?php

declare(strict_types=1);

namespace App\Tests\Functional\User;

use App\Tests\Functional\FunctionalTestBase;
use Lexik\Bundle\JWTAuthenticationBundle\Response\JWTAuthenticationFailureResponse;
use Lexik\Bundle\JWTAuthenticationBundle\Response\JWTAuthenticationSuccessResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class LoginCheckActionTest extends FunctionalTestBase
{
    private const ENDPOINT = '/api/v1/users/login_check';

    public function testLogin(): void
    {
        $payload = [
            'username' => 'luis@api.com',
            'password' => 'password'
        ];

        self::$authenticatedClient->request(Request::METHOD_POST, self::ENDPOINT, [], [], [], \json_encode($payload));

        $response = self::$authenticatedClient->getResponse();

        self::assertEquals(Response::HTTP_OK, $response->getStatusCode());
        self::assertInstanceOf(JWTAuthenticationSuccessResponse::class, $response);
        $responseData = \json_decode($response->getContent(), true);
        self::assertArrayHasKey('token', $responseData);
    }

    public function testLoginWithInvalidCredentials(): void
    {
        $payload = [
            'username' => 'luis@api.com',
            'password' => 'invalid-password',
        ];

        self::$baseClient->request(Request::METHOD_POST, self::ENDPOINT, [], [], [], \json_encode($payload));

        $response = self::$baseClient->getResponse();

        $this->assertEquals(Response::HTTP_UNAUTHORIZED, $response->getStatusCode());
        $this->assertInstanceOf(JWTAuthenticationFailureResponse::class, $response);
    }
}