<?php

declare(strict_types=1);

namespace App\Messenger\Message;

class ResendActivationEmailMessage
{
    public function __construct(
        public readonly string $name,
        public readonly string $email,
        public readonly string $code,
    )
    { }
}