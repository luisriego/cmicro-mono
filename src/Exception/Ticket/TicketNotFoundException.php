<?php

declare(strict_types=1);

namespace App\Exception\Ticket;

class TicketNotFoundException extends \DomainException
{
    public static function fromId(string $id): self
    {
        throw new self(\sprintf('Ticket with ID %s not found', $id));
    }
}
