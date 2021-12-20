<?php

declare(strict_types=1);

namespace App\Controller\Client;

use App\Entity\User;
use App\Exception\User\UserHasNotAuthorizationException;
use App\Http\DTO\Client\CreateClientRequest;
use App\Http\Response\ApiResponse;
use App\Messenger\Message\Client\ClientMessage;
use App\Repository\DoctrineUserRepository;
use App\Service\Client\CreateClientService;
use App\Service\User\CreateUserService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Messenger\MessageBusInterface;

class CreateClientAction extends AbstractController
{
    public function __construct(
        private CreateClientService $createClientService,
        private CreateUserService $createUserService,
        private DoctrineUserRepository $userRepository,
        private MessageBusInterface $bus
    ) { }

    public function __invoke(CreateClientRequest $request, User $user): ApiResponse
    {
        if (!$this->isGranted('ROLE_EMPLOYEE')) {
            throw new UserHasNotAuthorizationException();
        }

        $client = $this->createClientService->__invoke($request->companyName, $request->cnpj, $user);

        if ($client) {
            $this->bus->dispatch(new ClientMessage($request->companyName, $request->cnpj));
        }

        $user = $this->createUserService->__invoke($request->companyName, $request->email, $client->getCnpj());
        $user->addRole('ROLE_CLIENT');
        $this->userRepository->save($user);


        return new ApiResponse($client->toArray(), Response::HTTP_CREATED);
    }
}
