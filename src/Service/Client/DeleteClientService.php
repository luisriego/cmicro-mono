<?php

declare(strict_types=1);

namespace App\Service\Client;

use App\Exception\User\UserNotFoundException;
use App\Repository\DoctrineClientRepository;
use App\Repository\DoctrineUserRepository;

class DeleteClientService
{
    public function __construct(private DoctrineClientRepository $clientRepo)
    {
    }

    public function __invoke(string $id): void
    {
        if (null === $client = $this->clientRepo->findOneByIdOrFail($id)) {
            throw UserNotFoundException::fromId($id);
        }

        $this->clientRepo->remove($client);
    }
}