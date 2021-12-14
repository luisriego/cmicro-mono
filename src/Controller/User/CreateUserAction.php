<?php

declare(strict_types=1);

namespace App\Controller\User;

use App\Http\DTO\CreateUserRequest;
use App\Http\Response\ApiResponse;
use App\Messenger\Message\UserMessage;
use App\Service\User\CreateUserService;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Messenger\MessageBusInterface;

class CreateUserAction
{
    public function __construct(private CreateUserService $createUserService, private MessageBusInterface $bus)
    { }

    public function __invoke(CreateUserRequest $request): ApiResponse
    {
        $user = $this->createUserService->__invoke($request->getName(), $request->getEmail());

        if ($user) {
            $this->bus->dispatch(new UserMessage($request->getName(), $request->getEmail(), $user->getCode()));
        }

        return new ApiResponse($user->toArray(), Response::HTTP_CREATED);
    }
}
