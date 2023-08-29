<?php

namespace App\Infrastructure\Service;

use App\Domain\Entity\Users;
use App\Infrastructure\Repository\UsersRepository;

class UserService
{
    public function __construct(private UsersRepository $usersRepository) {}

    public function updateCode(string $email, string $code): void
    {
        $user = $this->getUser($email);
        $user->setCode($code);
        $user->setDtCode(new \DateTime('now'));

        $this->usersRepository->update();
    }

    public function getUser(string $email): ?Users
    {
        return $this->usersRepository->getUser($email);
    }
}