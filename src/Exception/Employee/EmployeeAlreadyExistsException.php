<?php

declare(strict_types=1);

namespace App\Exception\Employee;

class EmployeeAlreadyExistsException extends \DomainException
{
    public static function fromCpf(string $cpf): self
    {
        throw new self(\sprintf('Employee with CPF %s already exists', $cpf));
    }
}
