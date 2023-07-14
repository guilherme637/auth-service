<?php

namespace App\Domain\Entity;

class UserScope
{
    private int $id;
    private Users $users;
    private string $dsScope;

    public function getId(): int
    {
        return $this->id;
    }

    public function getUsers(): Users
    {
        return $this->users;
    }

    public function setUsers(Users $users): void
    {
        $this->users = $users;
    }

    public function getDsScope(): string
    {
        return $this->dsScope;
    }

    public function setDsScope(string $dsScope): void
    {
        $this->dsScope = $dsScope;
    }
}