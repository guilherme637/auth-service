<?php

namespace App\Infrastructure\Repository;

use App\Domain\Entity\RedirectUri;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class RedirectUriRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, RedirectUri::class);
    }

    public function getUriByClientId(string $clientId): ?RedirectUri
    {
        $qb = $this->createQueryBuilder('redirect_uri');

        $qb->innerJoin(
            'redirect_uri.clientId',
            'client',
            'WITH',
            'redirect_uri.clientId = client.id'
        );
        $qb->where('client.clientId = :clientId');
        $qb->setParameter('clientId', $clientId);

        return $qb->getQuery()->getSingleResult();
    }
}