<?php

declare(strict_types=1);

namespace App\Messenger\Handler;

use App\Mailer\IMailer;
use App\Mailer\TwigTemplate;
use App\Messenger\Message\UserRegisteredMessage;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;

class  UserRegisteredMessageHandler implements MessageHandlerInterface
{
    public function __construct(private IMailer $mailer)
    {
    }

    public function __invoke(UserRegisteredMessage $message): void
    {
        $payload = [
            'name' => $message->name,
            'email' => $message->email,
            'code' => $message->code
        ];

        $this->mailer->send($message->email, TwigTemplate::REGISTER_USER, $payload);
    }
}