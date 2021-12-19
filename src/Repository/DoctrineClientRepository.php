<?php

declare(strict_types=1);

namespace App\Repository;

use App\Entity\Client;
use App\Exception\Client\ClientNotFoundException;

class DoctrineClientRepository extends DoctrineBaseRepository
{
    protected static function entityClass(): string
    {
        return Client::class;
    }

    /**
     * @return Client[]
     */
    public function all(): array
    {
        return $this->objectRepository->findAll();
    }

    public function findOneByIdOrFail(string $id): ?Client
    {
        if (null === $client = $this->objectRepository->findOneBy(['id' => $id])) {
            throw ClientNotFoundException::fromId($id);
        }

        return $client;
    }

    public function findOneByCnpjOrFail(string $cnpj): ?Client
    {
        if (null === $user = $this->objectRepository->findOneBy(['cnpj' => $cnpj])) {
            throw ClientNotFoundException::fromCnpj($cnpj);
        }

        return $user;
    }

    public function save(Client $client): void
    {
        $this->saveEntity($client);
    }

    public function remove(Client $client): void
    {
        $this->removeEntity($client);
    }
}
