<?php

declare(strict_types=1);

namespace App\Tests\Functional\Employee;

use App\Tests\Functional\FunctionalTestBase;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class CreateEmployeeByAdminActionTest extends FunctionalTestBase
{
    private const ENDPOINT = '/api/v1/employees/create';

    public function testCreateEmployeeByAdmin(): void
    {
        $payload = [
            'name' => 'Juan',
            'email' => 'juan.cmicro@api.com',
            'client' => '04275304000112',
            'cpf' => '85084450678',
        ];

        self::$authenticatedClient->request(Request::METHOD_POST, self::ENDPOINT, [], [], [], \json_encode($payload));

        $response = self::$authenticatedClient->getResponse();

        self::assertEquals(Response::HTTP_CREATED, $response->getStatusCode());
        $responseData = \json_decode($response->getContent(), true);
        self::assertArrayHasKey('user', $responseData);
        self::assertArrayHasKey('cpf', $responseData);
        self::assertArrayHasKey('id', $responseData);
        self::assertArrayHasKey('createdOn', $responseData);
    }

//    public function testCreateClientWithoutAdminRoleMustFail(): void
//    {
//        $payload = [
//            'companyName' => 'Company',
//            'email' => 'admin@api.com',
//            'cnpj' => '00028986001007',
//        ];
//
//        self::$anotherAuthenticatedClient->request(Request::METHOD_POST, self::ENDPOINT, [], [], [], \json_encode($payload));
//
//        $response = self::$anotherAuthenticatedClient->getResponse();
//
//        self::assertEquals(Response::HTTP_FORBIDDEN, $response->getStatusCode());
//
//    }
//
//     public function testCreateClientWithInvalidCnpjMustFail(): void
//     {
//         $payload = [
//             'companyName' => 'Company',
//             'email' => 'admin@api.com',
//             'cnpj' => '00028986001006',
//         ];
//
//         self::$authenticatedClient->request(Request::METHOD_POST, self::ENDPOINT, [], [], [], \json_encode($payload));
//
//         $response = self::$authenticatedClient->getResponse();
//
//         self::assertEquals(Response::HTTP_INTERNAL_SERVER_ERROR, $response->getStatusCode());
//     }
//
//    public function testCreateClientWithInvalidEmailMustFail(): void
//    {
//        $payload = [
//            'companyName' => 'Company',
//            'email' => 'admin@api',
//            'cnpj' => '00028986001007',
//        ];
//
//        self::$authenticatedClient->request(Request::METHOD_POST, self::ENDPOINT, [], [], [], \json_encode($payload));
//
//        $response = self::$authenticatedClient->getResponse();
//
//        self::assertEquals(Response::HTTP_BAD_REQUEST, $response->getStatusCode());
//    }
//
//    public function testCreateClientWithInvalidNameMustFail(): void
//    {
//        $payload = [
//            'companyName' => 'Comp',
//            'email' => 'admin@api.com',
//            'cnpj' => '00028986001007',
//        ];
//
//        self::$authenticatedClient->request(Request::METHOD_POST, self::ENDPOINT, [], [], [], \json_encode($payload));
//
//        $response = self::$authenticatedClient->getResponse();
//
//        self::assertEquals(Response::HTTP_BAD_REQUEST, $response->getStatusCode());
//    }
}