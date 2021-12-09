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

        if (isset($data['surname']) && null !== $data['surname'] && $data['surname'] !== '') {
            $user->setSurname($data['surname']);
        }

        $user->setName($data['name']);
        $this->userRepository->save($user);

        return $user;
    }
}