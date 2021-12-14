<?php

declare(strict_types=1);

namespace App\Service\User;

use App\Entity\User;
use App\Exception\User\UserIsActiveException;
use App\Repository\DoctrineUserRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;

class ResendActivationEmailService
{
    public function __construct(private DoctrineUserRepository $userRepository)
    { }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function __invoke(string $email): User
    {
        $user = $this->userRepository->findOneByEmailOrFail($email);

        if ($user->isActive()) {
            throw UserIsActiveException::fromEmail($email);
        }

        $user->setCode(\sha1(\uniqid()));

        $this->userRepository->save($user);

        return $user;
    }
}