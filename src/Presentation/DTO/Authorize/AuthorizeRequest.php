<?php

namespace App\Presentation\DTO\Authorize;

use App\Domain\Enum\URIEnum;
use App\Domain\Enum\UrlEnum;
use Symfony\Component\HttpFoundation\RedirectResponse;

class AuthorizeRequest
{
    private ?string $responseType;
    private ?string $clientId;
    private ?string $redirectUri;
    private ?string $scope;
    private ?string $state;
    private ?string $error;

    public function getResponseType(): ?string
    {
        return $this->responseType ?? null;
    }

    public function setResponseType(?string $reponseType): void
    {
        $this->responseType = $reponseType;
    }

    public function getClientId(): ?string
    {
        return $this->clientId ?? null;
    }

    public function setClientId(?string $clientId): void
    {
        $this->clientId = $clientId;
    }

    public function getRedirectUri(): ?string
    {
        return $this->redirectUri ?? null;
    }

    public function setRedirectUri(?string $redirectUri): void
    {
        $this->redirectUri = $redirectUri;
    }

    public function getScope(): ?string
    {
        return $this->scope ?? null;
    }

    public function setScope(?string $scope): void
    {
        $this->scope = $scope;
    }

    public function getState(): ?string
    {
        return $this->state ?? null;
    }

    public function setState(?string $state): void
    {
        $this->state = $state;
    }

    public function getError(): ?string
    {
        return $this->error ?? null;
    }

    public function setError(?string $error): void
    {
        $this->error = $error;
    }

    public function makeLogin(): RedirectResponse
    {
        return new RedirectResponse(
            UrlEnum::HOST->value
            . sprintf(
                URIEnum::LOGIN->value,
                $this->responseType,
                $this->clientId,
                $this->redirectUri,
                $this->scope,
                $this->state
            )
        );
    }
}