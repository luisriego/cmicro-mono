<?php

declare(strict_types=1);

namespace App\Entity;

use App\Trait\IdentifierTrait;
use App\Trait\TimestampableTrait;
use Symfony\Component\Uid\Uuid;

class Employee
{
    use IdentifierTrait, TimestampableTrait;

    private string $cpf;
    private bool $isActive;
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

    public function getName()
    {
        return $this->name;
    }

    public function getSurname()
    {
        return $this->surname;
    }

    public function getCpf()
    {
        return $this->cpf;
    }

    public function getIsActive()
    {
        return $this->isActive;
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
}