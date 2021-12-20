<?php

declare(strict_types=1);

namespace App\Controller\Client;

use App\Exception\User\UserHasNotAuthorizationException;
use App\Http\Response\ApiResponse;
use App\Messenger\Message\Client\ClientMessage;
use App\Service\Client\DeleteClientService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class DeleteClientAction extends AbstractController
{
    public function __construct(private DeleteClientService $deleteClientService)
    { }

    public function __invoke(string $id): ApiResponse
    {
        if (!$this->isGranted('ROLE_EMPLOYEE')) {
            throw new UserHasNotAuthorizationException();
        }

        $this->deleteClientService->__invoke($id);

        return new ApiResponse([], Response::HTTP_NO_CONTENT);
    }
}
