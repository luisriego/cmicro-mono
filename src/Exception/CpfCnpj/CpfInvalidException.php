<?php

declare(strict_types=1);

namespace App\Exception\CpfCnpj;

class CpfInvalidException extends \DomainException
{
    public static function invalidLength(): self
    {
        throw new self('Password must be at least 11 characters exactly');
    }

    public static function InputValueDoesNotMatch(): self
    {
        throw new self('Please confirm your fiscal number');
    }
}
