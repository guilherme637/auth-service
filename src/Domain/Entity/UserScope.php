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

    public function getDsScope(): string
    {
        return $this->dsScope;
    }

    public function setDsScope(string $dsScope): void
    {
        $this->dsScope = $dsScope;
    }
}