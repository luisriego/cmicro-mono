<?php

declare(strict_types=1);

namespace App\Service\Client;

use App\Entity\Client;
use App\Exception\User\UserNotFoundException;
use App\Repository\DoctrineClientRepository;

class UpdateClientService
{
    public function __construct(private DoctrineClientRepository $clientRepo)
    {
    }

    public function __invoke(string $id, array $data): Client
    {
        if (null === $client = $this->clientRepo->findOneByIdOrFail($id)) {
            throw UserNotFoundException::fromId($id);
        }

        if (array_key_exists('companyName', $data) && ($client->getCompanyName() !== $data['companyName'])) {
            $client->setCompanyName($data['companyName']);
        }

        if (array_key_exists('xRays', $data) && $client->getXRays() !== $data['xRays']) {
            $client->setXRays($data['xRays']);
        }

        $this->clientRepo->save($client);

        return $client;
    }
}