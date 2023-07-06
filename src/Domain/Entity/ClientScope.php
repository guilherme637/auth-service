<?php

namespace App\Domain\Entity;

class ClientScope
{
    private string $clientId;
    private string $dsScope;

    public function getClientId(): string
    {
        return $this->clientId;
    }

    public function setClientId(string $clientId): void
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