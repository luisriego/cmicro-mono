<?php

declare(strict_types=1);

namespace App\Validator;

use App\Exception\CpfCnpj\CpfInvalidException;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class CpfValidator extends ConstraintValidator
{

    public function validate($value, Constraint $constraint)
    {
        if (!$this->cpfValidate($value)) {
            throw CpfInvalidException::InputValueDoesNotMatch();
        }
    }

    private function cpfValidate($value): bool
    {
        // Extrai somente os números
        $cpf = preg_replace( '/[^0-9]/is', '', $value );

        // Verifica se foi informado todos os digitos corretamente
        if (strlen($cpf) != 11) {
            return false;
        }

        // Verifica se foi informada uma sequência de digitos repetidos. Ex: 111.111.111-11
        if (preg_match('/(\d)\1{10}/', $cpf)) {
            return false;
        }

        // Faz o calculo para validar o CPF
        for ($t = 9; $t < 11; $t++) {
            for ($d = 0, $c = 0; $c < $t; $c++) {
                $d += $cpf[$c] * (($t + 1) - $c);
            }
            $d = ((10 * $d) % 11) % 10;
            if ($cpf[$c] != $d) {
                return false;
            }
        }
        return true;
    }
}