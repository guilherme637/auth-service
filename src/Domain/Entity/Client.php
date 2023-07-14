<?php

namespace App\Domain\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

class Client
{
    private int $id;
    private string $clientId;
    private string $clientSecret;
    private string $tokenEndpointAuthMethod;
    private Collection $redirecstUri;
    private string $clientName;
    private string $grantType;
    private \DateTime $clientIdIssuedAt;
    private \DateTime $clientSecretExpiresAt;
    private Collection $clientScopes;

    public function getId(): int
    {
        return $this->id;
    }

    public function getClientId(): string
    {
        return $this->clientId;
    }

    public function setClientId(string $clientId): void
    {
        $this->clientId = $clientId;
    }

    public function getClientSecret(): string
    {
        return $this->clientSecret;
    }

    public function setClientSecret(string $clientSecret): void
    {
        $this->clientSecret = $clientSecret;
    }

    public function getTokenEndpointAuthMethod(): string
    {
        return $this->tokenEndpointAuthMethod;
    }

    public function setTokenEndpointAuthMethod(string $tokenEndpointAuthMethod): void
    {
        $this->tokenEndpointAuthMethod = $tokenEndpointAuthMethod;
    }

    public function getRedirectsUri(): Collection
    {
        return $this->redirecstUri;
    }

    public function getClientName(): string
    {
        return $this->clientName;
    }

    public function setClientName(string $clientName): void
    {
        $this->clientName = $clientName;
    }

    public function getGrantType(): string
    {
        return $this->grantType;
    }

    public function setGrantType(string $grantType): void
    {
        $this->grantType = $grantType;
    }

    public function getClientIdIssuedAt(): \DateTime
    {
        return $this->clientIdIssuedAt;
    }

    public function setClientIdIssuedAt(\DateTime $clientIdIssuedAt): void
    {
        $this->clientIdIssuedAt = $clientIdIssuedAt;
    }

    public function getClientSecretExpiresAt(): \DateTime
    {
        return $this->clientSecretExpiresAt;
    }

    public function setClientSecretExpiresAt(\DateTime $clientSecretExpiresAt): void
    {
        $this->clientSecretExpiresAt = $clientSecretExpiresAt;
    }

    public function getClientScopes(): Collection
    {
        return $this->clientScopes;
    }
}