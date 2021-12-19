<?php

declare(strict_types=1);

namespace App\Entity;

use App\Trait\IdentifierTrait;
use App\Trait\TimestampableTrait;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\Uid\Uuid;

class Client
{
    use IdentifierTrait, TimestampableTrait;

    private string $companyName;
    private string $cnpj;
    private ?string $xRays;
    private bool $visible;
    private ?string $avatar;
    private Collection $users;
//    private Collection $tickets;

    public function __construct(
        string $companyName,
        string $cnpj
    ) {
        $this->id = Uuid::v4()->toRfc4122();
        $this->companyName = $companyName;
        $this->cnpj = $cnpj;
        $this->xRays = null;
        $this->visible = true;
        $this->avatar = "default.png";
        $this->users = new ArrayCollection();
//        $this->tickets = new ArrayCollection();
        $this->createdOn = new \DateTime();
        $this->createdOn = new \DateTime();
        $this->markAsUpdated();
    }


    public function getCompanyName(): string
    {
        return $this->companyName;
    }

    public function getCnpj(): string
    {
        return $this->cnpj;
    }

    public function getXRays(): string
    {
        return $this->xRays;
    }

    public function setXRays(?string $xRays): void
    {
        $this->xRays = $xRays;
    }

    public function getVisible(): bool
    {
        return $this->visible;
    }

    public function getAvatar(): string
    {
        return $this->avatar;
    }

    public function getUsers(): ArrayCollection|Collection
    {
        return $this->users;
    }

    public function addUser(User $user): void
    {
        if (!$this->users->contains($user)) {
            $this->users->add($user);
        }
    }

    public function removeUser(User $user): void
    {
        if ($this->users->contains($user)) {
            $this->users->removeElement($user);
        }
    }

//    /**
//     * @return ArrayCollection|Collection
//     */
//    public function getTickets(): ArrayCollection
//    {
//        return $this->tickets;
//    }
//
//    public function addTicket(Ticket $ticket): void
//    {
//        if (!$this->tickets->contains($ticket)) {
//            $this->tickets->add($ticket);
//        }
//    }
//
//    public function removeTicket(Ticket $ticket): void
//    {
//        if ($this->tickets->contains($ticket)) {
//            $this->tickets->removeElement($ticket);
//        }
//    }

    public function cnpjValidate(string $cnpj): bool
    {
        if (strlen($cnpj) != 14) {
            return false;
        }

        if ($this->knowToBeInvalids($cnpj)) {
            return false;
        }

        $j = 5;
        $k = 6;
        $soma1 = "";
        $soma2 = "";

        for ($i = 0; $i < 13; $i++) {

            $j = $j == 1 ? 9 : $j;
            $k = $k == 1 ? 9 : $k;

            $soma2 += ($cnpj[$i] * $k);

            if ($i < 12) {
                $soma1 += ($cnpj[$i] * $j);
            }

            $k--;
            $j--;

        }

        $digito1 = $soma1 % 11 < 2 ? 0 : 11 - $soma1 % 11;
        $digito2 = $soma2 % 11 < 2 ? 0 : 11 - $soma2 % 11;

        return (($cnpj[12] == $digito1) and ($cnpj[13] == $digito2));
    }

    private function knowToBeInvalids(string $cnpj): bool
    {
        // Elimina CNPJs invalidos conhecidos
        if ($cnpj == "00000000000000" ||
            $cnpj == "11111111111111" ||
            $cnpj == "22222222222222" ||
            $cnpj == "33333333333333" ||
            $cnpj == "44444444444444" ||
            $cnpj == "55555555555555" ||
            $cnpj == "66666666666666" ||
            $cnpj == "77777777777777" ||
            $cnpj == "88888888888888" ||
            $cnpj == "99999999999999")
        {
            return true;
        }

        return false;
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'name' => $this->companyName,
            'cnpj' => $this->cnpj,
            'createdOn' => $this->createdOn->format(\DateTime::RFC3339),
        ];
    }
}