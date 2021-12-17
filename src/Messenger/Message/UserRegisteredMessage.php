<?php

declare(strict_types=1);

namespace App\Messenger\Message;

class UserRegisteredMessage
{
    public function __construct(
        public readonly string $name,
        public readonly string $email,
        public readonly string $code
    )
    { }
}