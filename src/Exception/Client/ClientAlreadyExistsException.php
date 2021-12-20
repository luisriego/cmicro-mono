<?php

declare(strict_types=1);

namespace App\Exception\Client;

class ClientAlreadyExistsException extends \DomainException
{
    public static function fromcnpj(string $cnpj): self
    {
        throw new self(\sprintf('Client with CNPJ %s already exists', $cnpj));
    }
}
