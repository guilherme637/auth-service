<?php

namespace App\Domain\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

class Users
{
    private int $id;
    private string $username;
    private string $email;
    private string $password;
    private UserScope $scopes;
    private string $authorizationCode;
    private \DateTime $dtCode;
    private bool $authorize;

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getUsername(): string
    {
        return $this->username;
    }

    public function setUsername(string $username): void
    {
        $this->username = $username;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): void
    {
        $this->password = $password;
    }

    public function getScopes(): UserScope
    {
        return $this->scopes;
    }

    public function setScopes(UserScope $scopes): void
    {
        $this->scopes =  $scopes;
    }

    public function getCode(): string
    {
        return $this->authorizationCode;
    }

    public function setCode(string $authorizationCode): void
    {
        $this->authorizationCode = $authorizationCode;
    }

    public function getDtCode(): \DateTime
    {
        return $this->dtCode;
    }

    public function setDtCode(\DateTime $dtCode): void
    {
        $this->dtCode = $dtCode;
    }

    public function isAuthorize(): bool
    {
        return $this->authorize;
    }

    public function setAuthorize(bool $authorize): void
    {
        $this->authorize = $authorize;
    }
}