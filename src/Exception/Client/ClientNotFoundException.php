<?php

declare(strict_types=1);

namespace App\Exception\Client;

class ClientNotFoundException extends \DomainException
{
    public static function fromCnpj(string $cnpj): self
    {
        throw new self(\sprintf('Client with CNPJ %s not found', $cnpj));
    }

    public static function fromId(string $id): self
    {
        throw new self(\sprintf('Client with ID %s not found', $id));
    }
}
