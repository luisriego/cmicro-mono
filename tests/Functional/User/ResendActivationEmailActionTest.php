<?php

declare(strict_types=1);

namespace App\Tests\Functional\User;

use App\Tests\Functional\FunctionalTestBase;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class ResendActivationEmailActionTest extends FunctionalTestBase
{
    private const ENDPOINT = '/api/v1/users';

    public function testResendActivationEmail(): void
    {
        $payload = [
            'email' => 'inactiv@api.com'
        ];

        self::$baseClient->request(
            Request::METHOD_POST,
            \sprintf('%s/resend_activation_email', self::ENDPOINT),
            [], [], [],
            \json_encode($payload)
        );

        $response = self::$baseClient->getResponse();

        $this->assertEquals(Response::HTTP_OK, $response->getStatusCode());
    }

    public function testResendActivationEmailToActiveUser(): void
    {
        $payload = ['email' => 'default@api.com'];

        self::$baseClient->request(
            Request::METHOD_POST,
            \sprintf('%s/resend_activation_email', self::ENDPOINT),
            [], [], [],
            \json_encode($payload)
        );

        $response = self::$baseClient->getResponse();

        $this->assertEquals(Response::HTTP_CONFLICT, $response->getStatusCode());
    }
}