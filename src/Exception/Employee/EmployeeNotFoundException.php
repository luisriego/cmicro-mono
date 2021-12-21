<?php

declare(strict_types=1);

namespace App\Exception\Employee;

class EmployeeNotFoundException extends \DomainException
{
    public static function fromCpf(string $cpf): self
    {
        throw new self(\sprintf('Employee with CPF %s not found', $cpf));
    }

    public static function fromId(string $id): self
    {
        throw new self(\sprintf('Employee with ID %s not found', $id));
    }
}
