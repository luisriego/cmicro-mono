<?php

declare(strict_types=1);

namespace App\Controller\Client;

use App\Entity\User;
use App\Exception\User\UserHasNotAuthorizationException;
use App\Http\DTO\CreateUserRequest;
use App\Http\Response\ApiResponse;
use App\Messenger\Message\Client\ClientMessage;
use App\Messenger\Message\UserMessage;
use App\Messenger\Message\UserRegisteredMessage;
use App\Service\User\CreateUserService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Messenger\MessageBusInterface;

class CreateUserByClientAction extends AbstractController
{
    public function __construct(private CreateUserService $createUserService)
    { }

    public function __invoke(CreateUserRequest $request, User $currentUser): ApiResponse
    {
        if (!$this->isGranted('ROLE_CLIENT')) {
            throw new UserHasNotAuthorizationException();
        }

        if (!$this->isGranted('ROLE_EMPLOYEE')) {
            if ($currentUser->getClient()->getCnpj() !== $request->client ) {
                throw new UserHasNotAuthorizationException();
            }
        }

        $user = $this->createUserService->__invoke($request->name, $request->email, $request->client);

        return new ApiResponse($user->toArray(), Response::HTTP_CREATED);
    }
}
