<?php

namespace App\Infrastructure\Repository;

use App\Domain\Entity\Users;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\AbstractQuery;
use Doctrine\Persistence\ManagerRegistry;

class UsersRepository extends ServiceEntityRepository
{
    public function __construct(private ManagerRegistry $registry)
    {
        parent::__construct($registry, Users::class);
    }

    public function getPasswordByEmail(string $email): ?string
    {
        $password = $this->createQueryBuilder('u')
            ->select('u.password')
            ->where('u.email = :email')
            ->setParameter('email', $email)
            ->getQuery()
            ->getSingleColumnResult();

        return current($password) ?? null;
    }

    public function getEmail(string $email): ?string
    {
        $email = $this->createQueryBuilder('u')
            ->select('u.email')
            ->where('u.email = :email')
            ->setParameter('email', $email)
            ->getQuery()
            ->getSingleResult();

        return current($email) ?? null;
    }

    public function getUser(string $email): ?Users
    {
        return $this->createQueryBuilder('u')
            ->where('u.email = :email')
            ->setParameter('email', $email)
            ->getQuery()
            ->getSingleResult();
    }

    public function getUserByCode(string $code): ?Users
    {
        return $this->createQueryBuilder('u')
            ->where('u.authorizationCode = :code ')
            ->setParameter('code', $code)
            ->getQuery()
            ->getSingleResult();
    }

    public function getCode(string $code): array
    {
        return $this->createQueryBuilder('u')
            ->select(['u.authorizationCode', 'u.dtCode'])
            ->where('u.authorizationCode = :code')
            ->setParameter('code', $code)
            ->getQuery()
            ->getOneOrNullResult();
    }

    public function getEmailByCode(string $code): ?string
    {
        $email = $this->createQueryBuilder('u')
            ->select('u.email')
            ->where('u.authorizationCode = :code')
            ->setParameter('code', $code)
            ->getQuery()
            ->getSingleResult();

        return current($email) ?? null;
    }

    public function save(Users $user): void
    {
        $this->registry->getManager()->persist($user);
        $this->registry->getManager()->flush();
    }

    public function update(): void
    {
        $this->registry->getManager()->flush();
    }
}