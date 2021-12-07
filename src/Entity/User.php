<?php

declare(strict_types=1);

namespace App\Entity;

use App\Trait\IdentifierTrait;
use App\Trait\IsActiveTrait;
use App\Trait\TimestampableTrait;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Uid\Uuid;

class User implements UserInterface
{
    use IdentifierTrait;
    use TimestampableTrait;
    use IsActiveTrait;

    private string $name;
    private string $surname;
    private string $email;
    private ?string $password;
    private ?string $code;
    private ?string $avatar;
//    private ?Client $client;
//    private Collection $phones;

    public function __construct(string $name, string $email, ?string $surname = '') 
    {
        $this->id = Uuid::v4()->toRfc4122();
        $this->name = $name;
        $this->surname = '';
        $this->email = $email;
        $this->password = null;
        $this->code = \sha1(\uniqid());
        $this->avatar = null;
//        $this->client = null;
//        $this->phones = new ArrayCollection();
        $this->isActive = false;
        $this->createdOn = new \DateTime();
        $this->markAsUpdated();
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    public function getCode(): ?string
    {
        return $this->code;
    }

    public function setCode(?string $code): void
    {
        $this->code = $code;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(?string $password): void
    {
        $this->password = $password;
    }

//    public function getClient(): ?Client
//    {
//        return $this->client;
//    }
//
//    public function setClient(?Client $client): void
//    {
//        $this->client = $client;
//    }
//
//    /**
//     * @return ArrayCollection|Collection
//     */
//    public function getPhones(): ArrayCollection
//    {
//        return $this->phones;
//    }
//
//    public function addPhone(Phone $phone): void
//    {
//        if (!$this->phones->contains($phone)) {
//            $this->phones->add($phone);
//        }
//    }
//
//    public function removePhone(Phone $phone): void
//    {
//        if ($this->phones->contains($phone)) {
//            $this->phones->removeElement($phone);
//        }
//    }


    public function equals(User $user): bool
    {
        return $this->id === $user->getId();
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'name' => $this->fullName(),
            'email' => $this->email,
            'code' => $this->code,
            'createdOn' => $this->createdOn->format(\DateTime::RFC3339),
        ];
    }

    private function fullName(): string
    {
        if (null !== $this->surname) {
            return $this->name . ' ' . $this->surname;
        }
        return $this->name;
    }

//    Implementations

    public function getRoles(): array
    {
        return [];
    }

    public function getSalt()
    {
        // TODO: Implement getSalt() method.
    }

    public function eraseCredentials()
    {
        // TODO: Implement eraseCredentials() method.
    }

    public function getUsername(): string
    {
        return $this->email;
    }

    public function getUserIdentifier(): string
    {
        return $this->email;
    }

    public function __call(string $name, array $arguments)
    {
        // TODO: Implement @method string getUserIdentifier()
    }
}
