<?php

declare(strict_types=1);

namespace App\Controller\Employee;

use App\Exception\User\UserHasNotAuthorizationException;
use App\Http\DTO\CreateUserRequest;
use App\Http\DTO\Employee\CreateEmployeeRequest;
use App\Http\Response\ApiResponse;
use App\Service\Employee\CreateEmployeeService;
use App\Service\User\CreateUserService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class CreateEmployeeByAdminAction extends AbstractController
{
    public function __construct(private CreateUserService $createUserService, private CreateEmployeeService $createEmployeeService)
    { }

    public function __invoke(CreateUserRequest $request, CreateEmployeeRequest $employeeRequest): ApiResponse
    {
        if (!$this->isGranted('ROLE_ADMIN')) {
            throw new UserHasNotAuthorizationException();
        }

        $user = $this->createUserService->__invoke($request->name, $request->email, $request->client);

        $employee = $this->createEmployeeService->__invoke($employeeRequest->cpf, $user);

        return new ApiResponse($employee->toArray(), Response::HTTP_CREATED);
    }
}
