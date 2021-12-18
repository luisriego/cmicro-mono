<?php

declare(strict_types=1);

namespace App\Messenger\Handler;

use App\Mailer\IMailer;
use App\Mailer\TwigTemplate;
use App\Messenger\Message\ResendActivationEmailMessage;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;

class  ResendActivationEmailMessageHandler implements MessageHandlerInterface
{
    public function __construct(private IMailer $mailer)
    {
    }

    public function __invoke(ResendActivationEmailMessage $message): void
    {
        $payload = [
            'name' => $message->name,
            'email' => $message->email,
            'code' => $message->code
        ];

        $this->mailer->send($message->email, TwigTemplate::RESEND_ACTIVATION_EMAIL, $payload);
    }
}