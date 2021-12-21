<?php

namespace App\Http\DTO\Employee;

use App\Entity\Client;
use App\Http\DTO\RequestDTO;
use Symfony\Component\HttpFoundation\Request;
use App\Validator as MyAssert;
use Symfony\Component\Validator\Constraints as Assert;

class CreateEmployeeRequest implements RequestDTO
{
    #[Assert\NotBlank]
    #[Assert\Length(min: 11, max: 11)]
    #[MyAssert\Cpf]
    public readonly ?string $cpf;

    public function __construct(Request $request)
    {
        $this->cpf = $request->request->get('cpf');
    }
}
