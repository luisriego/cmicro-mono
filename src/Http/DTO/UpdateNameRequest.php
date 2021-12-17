<?php

namespace App\Http\DTO;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Constraints as Assert;

class UpdateNameRequest implements RequestDTO
{
    #[Assert\NotBlank]
    #[Assert\Length(min: 3)]
    public readonly ?string $name;

    public function __construct(Request $request)
    {
        $this->name = $request->request->get('name');
    }
}
