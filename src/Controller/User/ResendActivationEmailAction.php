<?php

declare(strict_types=1);

namespace App\Controller\User;

use App\Http\DTO\CreateUserRequest;
use App\Http\DTO\ResetPasswordRequest;
use App\Http\Response\ApiResponse;
use App\Messenger\Message\UserMessage;
use App\Service\User\CreateUserService;
use App\Service\User\ResendActivationEmailService;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Messenger\MessageBusInterface;

class ResendActivationEmailAction
{
    public function __construct(private ResendActivationEmailService $resendActivationEmailService, private MessageBusInterface $bus)
    { }

    /**
     * @throws \Doctrine\ORM\OptimisticLockException
     * @throws \Doctrine\ORM\ORMException
     */
    public function __invoke(ResetPasswordRequest $request): ApiResponse
    {
        $user = $this->resendActivationEmailService->__invoke($request->getEmail());

        if ($user) {
            $this->bus->dispatch(new UserMessage($user->getName(), $request->getEmail(), $user->getCode()));
        }

        return new ApiResponse($user->toArray(), Response::HTTP_OK);
    }
}
