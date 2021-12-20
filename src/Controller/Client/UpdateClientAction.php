<?php

declare(strict_types=1);

namespace App\Controller\Client;

use App\Exception\User\UserHasNotAuthorizationException;
use App\Http\Response\ApiResponse;
use App\Service\Client\UpdateClientService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

class UpdateClientAction extends AbstractController
{
    public function __construct(private UpdateClientService $updateClientService)
    {
    }

    public function __invoke(Request $request, string $id): ApiResponse
    {
        if (!$this->isGranted('ROLE_EMPLOYEE')) {
            throw new UserHasNotAuthorizationException();
        }

        $responseData = \json_decode($request->getContent(), true);

        $user = $this->updateClientService->__invoke($id, $responseData);

        return new ApiResponse($user->toArray());
    }
}