<?php

declare(strict_types=1);

namespace App\Validator;

use Symfony\Component\Validator\Constraint;

#[\Attribute]
class Cnpj extends Constraint
{
    public $message = 'The string contains an illegal CNPJ.';
}