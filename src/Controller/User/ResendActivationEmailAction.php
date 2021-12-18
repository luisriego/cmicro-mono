<?php

declare(strict_types=1);

namespace App\Controller\User;

use App\Http\DTO\CreateUserRequest;
use App\Http\DTO\ResetPasswordRequest;
use App\Http\Response\ApiResponse;
use App\Messenger\Message\ResendActivationEmailMessage;
use App\Messenger\Message\UserMessage;
use App\Service\User\CreateUserService;
use App\Service\User\ResendActivationEmailService;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Messenger\MessageBusInterface;

class ResendActivationEmailAction
{
    public function __construct(private ResendActivationEmailService $resendActivationEmailService, private MessageBusInterface $bus)
    { }

    /**
     * @throws OptimisticLockException
     * @throws ORMException
     */
    public function __invoke(ResetPasswordRequest $request): ApiResponse
    {
        $user = $this->resendActivationEmailService->__invoke($request->email);

        if ($user) {
            $this->bus->dispatch(new ResendActivationEmailMessage($user->getName(), $request->email, $user->getCode()));
        }

        return new ApiResponse($user->toArray(), Response::HTTP_OK);
    }
}