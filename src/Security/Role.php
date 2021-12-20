<?php

declare(strict_types=1);

namespace App\Security;

abstract class Role
{
    public const ROLE_ADMIN = 'ROLE_ADMIN';
    public const ROLE_CLIENT = 'ROLE_CLIENT';
    public const ROLE_EMPLOYEE = 'ROLE_EMPLOYEE';
    public const ROLE_USER = 'ROLE_USER';

    public static function getSupportedRoles(): array
    {
        return [
            self::ROLE_ADMIN,
            self::ROLE_CLIENT,
            self::ROLE_EMPLOYEE,
            self::ROLE_USER,
        ];
    }
}