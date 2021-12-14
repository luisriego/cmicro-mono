<?php

declare(strict_types=1);

namespace App\Messenger\Handler;

use App\Messenger\Message\RequestResetPasswordMessage;
use Psr\Log\LoggerInterface;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;
use App\Messenger\Message\UserMessage;

class RequestResetPasswordMessageHandler implements MessageHandlerInterface
{
    public function __construct(private LoggerInterface $logger)
    {
    }

    public function __invoke(RequestResetPasswordMessage $message): void
    {
        $this->logger->info('REQUEST RESET PASSWORD');
        $this->logger->info(sprintf('Name: %s. Email: %s. Code: %s', $message->name, $message->email, $message->code));
    }
}