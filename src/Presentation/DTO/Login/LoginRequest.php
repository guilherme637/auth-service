<?php

namespace App\Presentation\DTO\Login;

use App\Domain\Enum\URIEnum;
use Symfony\Component\HttpFoundation\RedirectResponse;

class LoginRequest
{
    private string $email;
    private string $password;
    private string $_token;
    private string $clientId;

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function getToken(): string
    {
        return $this->_token;
    }

    public function getClientId(): string
    {
        return $this->clientId;
    }

    public function doRedirect(string $url, string $state, string $code): RedirectResponse
    {
        return new RedirectResponse($url . sprintf(URIEnum::CHECK->value, $state, $code));
    }
}