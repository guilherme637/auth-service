<?php

namespace App\Domain\Service\User;

use App\Domain\Entity\Users;

interface UserServiceInterface
{
    public function updateCode(string $email, string $code): void;
    public function getUser(string $email): ?Users;
    public function getUserByCode(string $code): ?Users;
}