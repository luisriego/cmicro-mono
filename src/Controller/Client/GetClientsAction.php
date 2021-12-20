<?php

declare(strict_types=1);

namespace App\Controller\Client;

use App\Entity\Client;
use App\Exception\User\UserHasNotAuthorizationException;
use App\Http\Response\ApiResponse;
use App\Repository\DoctrineClientRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class GetClientsAction extends AbstractController
{
    public function __construct(private DoctrineClientRepository $clientRepo)
    {
    }

    public function __invoke(): ApiResponse
    {
        if (!$this->isGranted('ROLE_EMPLOYEE')) {
            throw new UserHasNotAuthorizationException();
        }

        $clients = $this->clientRepo->all();

        $result = array_map(function (Client $client): array {
            return $client->toArray();
        }, $clients);

        return new ApiResponse(['clients' => $result]);
    }
}