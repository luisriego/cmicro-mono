<?php

namespace App\Service\User;

use App\Entity\User;
use App\Exception\User\UserNotFoundException;
use App\Repository\DoctrineUserRepository;

class ActivateUserService
{
    public function __construct(
        private DoctrineUserRepository $userRepository,
        private EncodePasswordService $encodePassword
    )
    { }

    public function __invoke(string $email, string $code, string $password): User
    {
//        if (null === $user = $this->userRepository->findOneByEmailAndToken($email, $token)) {
//            throw new UserNotFoundException("This User can't be Activate because not exist yet");
//        }
        $user = $this->userRepository->findOneInactiveByEmailAndTokenOrFail($email, $code);
        $user->setPassword($this->encodePassword->generateEncodedPassword($user, $password));
        $user->toggleActive();
        $user->setCode(null);
        $this->userRepository->save($user);

        return $user;
    }
}