<?php

namespace App\Presentation\DTO\Token;

class TokenRequest
{
    public const GRANT_TYPE = 'authorization_code';

    private string $grantType;
    private string $code;
    private string $clientId;
    private string $clientSecret;
    private ?string $redirectUri;

    public function __construct(
        string $grantType,
        string $code,
        string $clientId,
        string $clientSecret,
        ?string $redirectUri
    ) {
        $this->grantType = $grantType;
        $this->code = $code;
        $this->clientId = $clientId;
        $this->clientSecret = $clientSecret;
        $this->redirectUri = $redirectUri;
    }

    public function getGrantType(): string
    {
        return $this->grantType;
    }

    public function setGrantType(string $grantType): void
    {
        $this->grantType = $grantType;
    }

    public function getCode(): string
    {
        return $this->code;
    }

    public function setCode(string $code): void
    {
        $this->code = $code;
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

    public function getRedirectUri(): string
    {
        return $this->redirectUri;
    }

    public function setRedirectUri(string $redirectUri): void
    {
        $this->redirectUri = $redirectUri;
    }
}