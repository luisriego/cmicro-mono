<?php

declare(strict_types=1);

namespace App\Controller\User;

use App\Http\DTO\ResetPasswordRequest;
use App\Http\Response\ApiResponse;
use App\Messenger\Message\RequestResetPasswordMessage;
use App\Messenger\Message\UserMessage;
use App\Service\User\RequestResetPasswordService;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Symfony\Component\Messenger\MessageBusInterface;

class RequestResetPasswordAction
{
    public function __construct(private RequestResetPasswordService $resetPasswordService, private MessageBusInterface $bus)
    { }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function __invoke(ResetPasswordRequest $resetPasswordRequest): ApiResponse
    {
        $user = $this->resetPasswordService->__invoke($resetPasswordRequest->email);

        if ($user) {
            $this->bus->dispatch(new RequestResetPasswordMessage($user->getName(), $resetPasswordRequest->email, $user->getCode()));
        }

        return new ApiResponse(['message' => 'Request reset password email sent']);
    }
}