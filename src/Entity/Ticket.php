<?php

declare(strict_types=1);

namespace App\Entity;

use App\Trait\IdentifierTrait;
use App\Trait\TimestampableTrait;
use Symfony\Component\Uid\Uuid;

class Ticket
{
    use IdentifierTrait, TimestampableTrait;

    private string $message;
    private ?\DateTime $endedOn;
    private Client $client;

    public function __construct(string $message, Client $client)
    {
        $this->id = Uuid::v4()->toRfc4122();
        $this->message = $message;
        $this->client = $client;
        $this->endedOn = null;
        $this->createdOn = new \DateTime();
        $this->createdOn = new \DateTime();
        $this->markAsUpdated();
    }

    public function getMessage(): string
    {
        return $this->message;
    }

    public function setMessage(string $message): void
    {
        $this->message = $message;
    }

    public function getEndedOn(): ?\DateTime
    {
        return $this->endedOn;
    }

    public function setEndedOn(?\DateTime $endedOn): void
    {
        $this->endedOn = $endedOn;
    }

    public function getClient(): Client
    {
        return $this->client;
    }

    public function setClient(Client $client): void
    {
        $this->client = $client;
    }
}