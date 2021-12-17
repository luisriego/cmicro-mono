<?php

namespace App\Http\DTO;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Constraints as Assert;

class CreateUserRequest implements RequestDTO
{
    #[Assert\NotBlank]
    #[Assert\Length(min: 3, max: 20)]
    public readonly ?string $name;

    #[Assert\NotBlank]
    #[Assert\Email]
    public readonly ?string $email;

    public function __construct(Request $request)
    {
        $this->name = $request->request->get('name');
        $this->email = $request->request->get('email');
    }
}
