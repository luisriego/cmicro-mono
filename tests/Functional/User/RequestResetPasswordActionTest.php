<?php

declare(strict_types=1);

namespace App\Tests\Functional\User;

use App\Tests\Functional\FunctionalTestBase;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class RequestResetPasswordActionTest extends FunctionalTestBase
{
    private const ENDPOINT = '/api/v1/users';

    public function testRequestResetPassword(): void
    {
        $payload = [
            'email' => 'luis@api.com'
        ];

        self::$baseClient->request(
            Request::METHOD_POST,
            \sprintf('%s/request_reset_password', self::ENDPOINT),
            [], [], [],
            \json_encode($payload)
        );

        $response = self::$baseClient->getResponse();

        self::assertEquals(Response::HTTP_OK, $response->getStatusCode());
        $responseData = \json_decode($response->getContent(), true);

        self::assertEquals(Response::HTTP_OK, $response->getStatusCode());
        self::assertEquals('Request reset password email sent', $responseData['message']);
    }

//    public function testRequestResetPasswordForNonExistingEmail(): void
//    {
//        $payload = ['email' => 'non-existing@api.com'];
//
//        self::$peter->request(
//            'POST',
//            \sprintf('%s/request_reset_password', $this->endpoint),
//            [],
//            [],
//            [],
//            \json_encode($payload)
//        );
//
//        $response = self::$peter->getResponse();
//
//        $this->assertEquals(JsonResponse::HTTP_NOT_FOUND, $response->getStatusCode());
//    }
}