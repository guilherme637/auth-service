<?php

namespace App\Domain\Entity;

class RedirectUri
{
    private int $id;
    private Client $clientId;
    private string $uriRedirect;

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

    public function getUriRedirect(): string
    {
        return $this->uriRedirect;
    }

    public function setUriRedirect(string $uriRedirect): void
    {
        $this->uriRedirect = $uriRedirect;
    }
}