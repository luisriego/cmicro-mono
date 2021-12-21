<?php

declare(strict_types=1);

namespace App\Entity;

use App\Trait\IdentifierTrait;
use App\Trait\IsActiveTrait;
use App\Trait\TimestampableTrait;
use JetBrains\PhpStorm\ArrayShape;
use Symfony\Component\Uid\Uuid;

class Employee
{
    use IdentifierTrait, TimestampableTrait, IsActiveTrait;

    private string $cpf;
    private User $user;

    public function __construct(string $cpf, User $user)
    {
        $this->id = Uuid::v4()->toRfc4122();
        $this->cpf = $cpf;
        $this->user = $user;
        $this->isActive = true;
        $this->createdOn = new \DateTime();
        $this->createdOn = new \DateTime();
        $this->markAsUpdated();
    }

    public function getCpf()
    {
        return $this->cpf;
    }

    public function setCpf(string $cpf): void
    {
        $this->cpf = $this->cleanCpf($cpf);
    }

    public function fire(): void
    {
        $this->isActive = false;
    }

    public function getUser(): User
    {
        return $this->user;
    }

    public function setUser(User $user): void
    {
        $this->user = $user;
    }

    // public function assign(Ticket $ticket): void
    // {
    //     # code to add a new ticket to the employee
    // }

    private function cleanCpf(string $value): array|string
    {
        $value = trim($value);
        return str_replace(array('.', ',', '-', '/'), '', $value);
    }

    #[ArrayShape(['id' => "string", 'cpf' => "string", 'user' => "string", 'createdOn' => "string"])]
    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'cpf' => $this->cpf,
            'user' => $this->user->fullName(),
            'createdOn' => $this->createdOn->format(\DateTime::RFC3339),
        ];
    }
}