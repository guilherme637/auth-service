<?php

namespace App\Domain\Entity;

class RedirectUri
{
    private string $clientId;
    private string $uriRedirect;

    public function getClientId(): string
    {
        return $this->clientId;
    }

    public function setClientId(string $clientId): void
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