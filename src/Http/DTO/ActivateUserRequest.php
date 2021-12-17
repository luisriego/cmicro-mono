<?php

namespace App\Http\DTO;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Constraints as Assert;

class ActivateUserRequest implements RequestDTO
{
    #[Assert\NotBlank]
    #[Assert\Email]
    public readonly ?string $email;

    #[Assert\NotBlank]
    #[Assert\Length(min: 40, max: 40)]
    public readonly ?string $code;

    #[Assert\NotBlank]
    #[Assert\Length(min: 6, max: 20)]
    public readonly ?string $password;

    public function __construct(Request $request)
    {
        $this->email = $request->request->get('email');
        $this->code = $request->request->get('code');
        $this->password = $request->request->get('password');
    }
}
