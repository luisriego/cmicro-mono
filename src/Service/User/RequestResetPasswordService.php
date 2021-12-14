<?php

declare(strict_types=1);

namespace App\Service\User;

use App\Entity\User;
use App\Messenger\Message\RequestResetPasswordMessage;
use App\Messenger\RoutingKey;
use App\Repository\DoctrineUserRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Symfony\Component\Messenger\Bridge\Amqp\Transport\AmqpStamp;
use Symfony\Component\Messenger\MessageBusInterface;

class RequestResetPasswordService
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
        $user->setCode(\sha1(\uniqid()));

        $this->userRepository->save($user);

        return $user;
    }
}