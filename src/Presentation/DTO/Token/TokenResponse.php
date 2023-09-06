<?php

namespace App\Presentation\DTO\Token;

class TokenResponse
{
    private string $accessToken;
    public function __construct(string $accessToken)
    {
        $this->accessToken = $accessToken;
    }

    public function getAccessTokenVO(): string
    {
        return $this->accessToken;
    }

    public function setAccessTokenVO(string $accessToken): void
    {
        $this->accessToken = $accessToken;
    }
}