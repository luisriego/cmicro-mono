<?php

declare(strict_types=1);

namespace App\Controller\User;

use App\Exception\User\UserHasNotAuthorizationException;
use App\Http\DTO\CreateUserRequest;
use App\Http\Response\ApiResponse;
use App\Messenger\Message\UserMessage;
use App\Messenger\Message\UserRegisteredMessage;
use App\Service\User\CreateUserService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Messenger\MessageBusInterface;

class CreateEmployeeAction extends AbstractController
{
    public function __construct(private CreateUserService $createUserService)
    { }

    public function __invoke(CreateUserRequest $request): ApiResponse
    {
        if (!$this->isGranted('ROLE_EMPLOYEE')) {
            throw new UserHasNotAuthorizationException();
        }

        $user = $this->createUserService->__invoke($request->name, $request->email, $request->client, true);

//        if ($user) {
//            $this->bus->dispatch(new UserMessage($request->name, $request->email, $user->getCode()));
//            $this->bus->dispatch(new UserRegisteredMessage($request->name, $request->email, $user->getCode()));
//        }

        return new ApiResponse($user->toArray(), Response::HTTP_CREATED);
    }
}
