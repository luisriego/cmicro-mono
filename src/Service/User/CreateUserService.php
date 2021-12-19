<?php

namespace App\Service\User;

use App\Entity\User;
use App\Exception\Client\ClientNotFoundException;
use App\Exception\User\UserAlreadyExistsException;
use App\Repository\DoctrineClientRepository;
use App\Repository\DoctrineUserRepository;
use Doctrine\ORM\ORMException;

class CreateUserService
{
    public function __construct(
        private DoctrineUserRepository $userRepository,
        private DoctrineClientRepository $clientRepo)
    { }

    public function __invoke(string $name, string $email, string $cnpj): User
    {
        if (null === $client = $this->clientRepo->findOneByCnpjOrFail($cnpj)) {
            throw ClientNotFoundException::fromCnpj($cnpj);
        }

        if ($this->userRepository->findOneByEmail($email)) {
            throw UserAlreadyExistsException::fromEmail($email);
        }

        $user = new User($name, $email, $client);

        try {
            $this->userRepository->save($user);
        } catch (ORMException $e) {
            throw UserAlreadyExistsException::fromEmail($email);
        }

        return $user;
    }
}
