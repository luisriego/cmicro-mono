<?php

namespace App\Service\Client;

use App\Entity\Client;
use App\Exception\Client\ClientAlreadyExistsException;
use App\Repository\DoctrineClientRepository;
use Doctrine\ORM\ORMException;

class CreateClientService
{
    public function __construct(private DoctrineClientRepository $clientRepo)
    { }

    public function __invoke(string $companyName, string $cnpj): Client
    {
        if ($this->clientRepo->findOneByCnpj($cnpj)) {
            throw ClientAlreadyExistsException::fromCnpj($cnpj);
        }

        $client = new Client($companyName, $cnpj);

        try {
            $this->clientRepo->save($client);
        } catch (ORMException $e) {
            throw ClientAlreadyExistsException::fromcnpj($cnpj);
        }

        return $client;
    }
}
