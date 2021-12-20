<?php

namespace App\Controller\Client;


use App\Exception\User\UserHasNotAuthorizationException;
use App\Http\Response\ApiResponse;
use App\Service\Client\GetClientByIdService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class GetClientByIdAction extends AbstractController
{
    public function __construct(private GetClientByIdService $getClientByIdService)
    {
    }

    public function __invoke(string $id): ApiResponse
    {
        if (!$this->isGranted('ROLE_EMPLOYEE')) {
            throw new UserHasNotAuthorizationException();
        }

        $client = $this->getClientByIdService->__invoke($id);

        return new ApiResponse($client->toArray());
    }
}