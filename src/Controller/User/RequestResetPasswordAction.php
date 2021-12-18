<?php

declare(strict_types=1);

namespace App\Controller\User;

use App\Http\DTO\ResetPasswordRequest;
use App\Http\Response\ApiResponse;
use App\Messenger\Message\RequestResetPasswordMessage;
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
    public function __invoke(ResetPasswordRequest $request): ApiResponse
    {
        $user = $this->resetPasswordService->__invoke($request->email);

        if ($user) {
            $this->bus->dispatch(new RequestResetPasswordMessage($user->getName(), $request->email, $user->getCode()));
            $this->bus->dispatch(new RequestResetPasswordMessage($user->getName(), $request->email, $user->getCode()));
        }

        return new ApiResponse(['message' => 'Request reset password email sent']);
    }
}