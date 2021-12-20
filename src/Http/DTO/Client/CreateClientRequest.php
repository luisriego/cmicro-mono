<?php

namespace App\Http\DTO\Client;

use App\Entity\Client;
use App\Http\DTO\RequestDTO;
use Symfony\Component\HttpFoundation\Request;
use App\Validator as MyAssert;
use Symfony\Component\Validator\Constraints as Assert;

class CreateClientRequest implements RequestDTO
{
    #[Assert\NotBlank]
    #[Assert\Length(min: 5, max: 50)]
    public readonly ?string $companyName;

    #[Assert\NotBlank]
    #[Assert\Length(min: 14, max: 14)]
    #[MyAssert\Cnpj]
    public readonly ?string $cnpj;

    #[Assert\NotBlank]
    #[Assert\Email]
    public readonly ?string $email;

    public function __construct(Request $request)
    {
        $this->companyName = $request->request->get('companyName');
        $this->email = $request->request->get('email');
        $this->cnpj = $request->request->get('cnpj');
    }
}
