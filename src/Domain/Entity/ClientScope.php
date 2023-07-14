<?php

namespace App\Domain\Entity;

class ClientScope
{
    private int $id;
    private Client $clientId;
    private string $dsScope;

    public function getId(): int
    {
        return $this->id;
    }

    public function getClientId(): Client
    {
        return $this->clientId;
    }

    public function setClientId(Client $clientId): void
    {
        $this->clientId = $clientId;
    }

    public function getDsScope(): string
    {
        return $this->dsScope;
    }

    public function setDsScope(string $dsScope): void
    {
        $this->dsScope = $dsScope;
    }
}