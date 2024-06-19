<?php

namespace App\Domain\Service\User;

use App\Domain\Adapter\Redis\RedisAdapterInterface;
use App\Domain\Entity\Users;
use App\Infrastructure\Repository\UsersRepository;

class UserService implements UserServiceInterface
{
    public function __construct(
        private readonly UsersRepository $usersRepository,
        private readonly RedisAdapterInterface $redisAdapter
    ) {}

    public function updateCode(string $email, string $code): void
    {
        $user = $this->getUser($email);
        $user->setCode($code);
        $user->setDtCode(new \DateTime('now'));

        $this->usersRepository->update();
        $this->redisAdapter->setExpKey($email, 120, $code);
    }

    public function getUser(string $email): ?Users
    {
        return $this->usersRepository->getUser($email);
    }

    public function getUserByCode(string $code): ?Users
    {
        return $this->usersRepository->getUserByCode($code);
    }
}