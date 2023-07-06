<?php

namespace App\Domain\Entity;

use Doctrine\Common\Collections\ArrayCollection;

class Client
{
    private string $clientId;
    private string $clientSecret;
    private string $tokenEndpointAuthMethod;
    private ArrayCollection $redirecstUri;
    private string $clientName;
    private string $grantType;
    private \DateTime $clientIdIssuedAt;
    private \DateTime $clientSecretExpiresAt;
    private ArrayCollection $clientScopes;

    public function __construct()
    {
        $this->redirecstUri = new ArrayCollection();
        $this->clientScopes = new ArrayCollection();
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

    public function getRedirectsUri(): ArrayCollection
    {
        return $this->redirecstUri;
    }

    public function setRedirectsUri(RedirectUri $redirectUri): void
    {
        $this->redirecstUri->add($redirectUri);
    }

    public function getClientName(): string
    {
        return $this->clientName;
    }

    public function setClientName(string $clientName): void
    {
        $this->clientName = $clientName;
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

    public function getClientScopes(): ArrayCollection
    {
        return $this->clientScopes;
    }

    public function setClientScopes(ClientScope $clientScopes): void
    {
        $this->clientScopes->add($clientScopes);
    }
}