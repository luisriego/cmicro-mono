<?php

namespace App\Http\DTO;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Constraints as Assert;

class ResetPasswordRequest implements RequestDTO
{
    #[Assert\NotBlank]
    #[Assert\Email]
    private ?string $email;

    public function __construct(Request $request)
    {
        $this->email = $request->request->get('email');
    }

    public function getEmail()
    {
        return $this->email;
    }
}
