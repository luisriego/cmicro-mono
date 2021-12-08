<?php

declare(strict_types=1);

namespace App\Service\User;

use App\Entity\User;
use App\Exception\User\UserNotFoundException;
use App\Repository\DoctrineUserRepository;

class UpdateUserService
{
    public function __construct(private DoctrineUserRepository $userRepository)
    {
    }

    public function __invoke(string $id, array $data): User
    {
        if (null === $user = $this->userRepository->findOneByIdOrFail($id)) {
            throw UserNotFoundException::fromId($id);
        }

        if (null !== $name = $data['name']) {
            $user->setName($name);
        }

        if (null !== $surname = $data['surname']) {
            $user->setSurname($surname);
        }

        $this->userRepository->save($user);

        return $user;
    }
}