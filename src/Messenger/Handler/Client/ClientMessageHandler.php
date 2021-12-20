<?php

declare(strict_types=1);

namespace App\Messenger\Handler\Client;

use App\Messenger\Message\Client\ClientMessage;
use Psr\Log\LoggerInterface;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;

class  ClientMessageHandler implements MessageHandlerInterface
{
    public function __construct(private LoggerInterface $logger)
    {
    }

    public function __invoke(ClientMessage $message): void
    {
        $this->logger->info('NEW MESSAGE');
        $this->logger->info(sprintf('Name: %s. CNPJ: %s', $message->companyName, $message->cnpj));
    }
}