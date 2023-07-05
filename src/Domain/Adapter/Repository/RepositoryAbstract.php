<?php

namespace App\Domain\Adapter\Repository;

use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Mapping\ClassMetadata;

class RepositoryAbstract extends EntityRepository
{
    public function __construct(EntityManagerInterface $em, string $class)
    {
        parent::__construct($em, new ClassMetadata($class));
    }

    public function search(int $id): ?object
    {
        return $this->find($id);
    }

    public function all(): array
    {
        return $this->findAll();
    }

    public function searchBy(array $criteria, ?array $orderBy = null, $limit = null, $offset = null): array
    {
        return $this->findBy($criteria, $orderBy, $limit, $offset);
    }

    public function searchOneBy(array $criteria, ?array $orderBy = null): ?object
    {
        return $this->findOneBy($criteria, $orderBy);
    }

    public function getEM(): EntityManagerInterface
    {
       return $this->getEntityManager();
    }
}