<?php

declare(strict_types=1);

namespace App\Validator;

use App\Exception\CpfCnpj\CnpjInvalidException;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class CnpjValidator extends ConstraintValidator
{

    public function validate($value, Constraint $constraint)
    {
        if (!$this->cnpjValidate($value)) {
            throw CnpjInvalidException::InputValueDoesNotMatch();
        }
    }

    private function cnpjValidate($value): bool
    {
        $value = preg_replace('/[^0-9]/', '', (string) $value);

        // Valida tamanho
        if (strlen($value) != 14)
            return false;

        // Verifica se todos os digitos são iguais
        if (preg_match('/(\d)\1{13}/', $value))
            return false;

        // Valida primeiro dígito verificador
        for ($i = 0, $j = 5, $soma = 0; $i < 12; $i++)
        {
            $soma += $value[$i] * $j;
            $j = ($j == 2) ? 9 : $j - 1;
        }

        $resto = $soma % 11;

        if ($value[12] != ($resto < 2 ? 0 : 11 - $resto))
            return false;

        // Valida segundo dígito verificador
        for ($i = 0, $j = 6, $soma = 0; $i < 13; $i++)
        {
            $soma += $value[$i] * $j;
            $j = ($j == 2) ? 9 : $j - 1;
        }

        $resto = $soma % 11;

        return $value[13] == ($resto < 2 ? 0 : 11 - $resto);
    }
}