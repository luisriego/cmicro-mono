<?php

declare(strict_types=1);

namespace App\Messenger\Message\Client;

class ClientMessage
{
    public function __construct(
        public readonly string $companyName,
        public readonly string $cnpj,
    )
    { }
}