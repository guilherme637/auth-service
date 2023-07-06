<?php

namespace App\Domain\Entity;

use Doctrine\Common\Collections\ArrayCollection;

class Users
{
    private int $id;
    private string $username;
    private string $email;
    private string $password;
    private ArrayCollection $scopes;

    public function __construct()
    {
        $this->scopes = new ArrayCollection();
    }

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

    public function getScopes(): ArrayCollection
    {
        return $this->scopes;
    }

    public function setScopes(ArrayCollection $scopes): void
    {
        $this->scopes = $scopes;
    }
}