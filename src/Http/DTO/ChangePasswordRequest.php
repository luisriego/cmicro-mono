<?php

namespace App\Http\DTO;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Constraints as Assert;

class ChangePasswordRequest implements RequestDTO
{
    #[Assert\NotBlank]
    #[Assert\Length(min: 6)]
    public readonly ?string $oldPass;

    #[Assert\NotBlank]
    #[Assert\Length(min: 6)]
    public readonly ?string $newPass;

    public function __construct(Request $request)
    {
        $this->oldPass = $request->request->get('oldPass');
        $this->newPass = $request->request->get('newPass');
    }
}
