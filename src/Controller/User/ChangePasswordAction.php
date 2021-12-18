<?php

declare(strict_types=1);

namespace App\Controller\User;

use App\Entity\User;
use App\Http\DTO\ChangePasswordRequest;
use App\Http\Response\ApiResponse;
use App\Messenger\Message\ChangePasswordMessage;
use App\Messenger\Message\RequestResetPasswordMessage;
use App\Service\User\ChangePasswordService;
use Symfony\Component\Messenger\MessageBusInterface;

class ChangePasswordAction
{
    public function __construct(private ChangePasswordService $changePasswordService, private MessageBusInterface $bus)
    {
    }

    public function __invoke(ChangePasswordRequest $request, User $user): ApiResponse
    {
        $user = $this->changePasswordService->__invoke($request->oldPass, $request->newPass, $user);

        if ($user) {
            $this->bus->dispatch(new ChangePasswordMessage($user->getName(), $user->getEmail()));
        }

        return new ApiResponse($user->toArray());
    }
}