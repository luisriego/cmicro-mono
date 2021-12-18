<?php

declare(strict_types=1);

namespace App\Messenger\Handler;

use App\Mailer\IMailer;
use App\Mailer\TwigTemplate;
use App\Messenger\Message\RequestResetPasswordMessage;
use App\Messenger\Message\UserRegisteredMessage;
use Psr\Log\LoggerInterface;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;
use App\Messenger\Message\UserMessage;

class RequestResetPasswordMessageHandler implements MessageHandlerInterface
{
    public function __construct(private IMailer $mailer)
    {
    }

    public function __invoke(RequestResetPasswordMessage $message): void
    {
        $payload = [
            'name' => $message->name,
            'email' => $message->email,
            'code' => $message->code
        ];

        $this->mailer->send($message->email, TwigTemplate::RESET_PASSWORD, $payload);
    }
}