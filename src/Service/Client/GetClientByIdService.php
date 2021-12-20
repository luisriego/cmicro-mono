<?php

namespace App\Service\Client;

use App\Entity\Client;
use App\Entity\User;
use App\Exception\Client\ClientNotFoundException;
use App\Repository\DoctrineClientRepository;

class GetClientByIdService
{
    public function __construct(private DoctrineClientRepository $clientRepo)
    {
    }

    public function __invoke(string $id): Client
    {
        if (null === $client = $this->clientRepo->findOneById($id)) {
            throw ClientNotFoundException::fromId($id);
        }

        return $client;
    }
}