<?php

declare(strict_types=1);

namespace App\Repository;

use App\Entity\Ticket;
use App\Exception\Ticket\TicketNotFoundException;

class DoctrineTicketRepository extends DoctrineBaseRepository
{
    protected static function entityClass(): string
    {
        return Ticket::class;
    }

    /**
     * @return Ticket[]
     */
    public function all(): array
    {
        return $this->objectRepository->findAll();
    }

    public function findOneByIdOrFail(string $id): ?Ticket
    {
        if (null === $ticket = $this->objectRepository->findOneBy(['id' => $id])) {
            throw TicketNotFoundException::fromId($id);
        }

        return $ticket;
    }

    public function save(Ticket $ticket): void
    {
        $this->saveEntity($ticket);
    }

    public function remove(Ticket $ticket): void
    {
        $this->removeEntity($ticket);
    }
}
