<?php

namespace App\Repository;

use App\Entity\Bearbeiter;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Bearbeiter>
 */
class BearbeiterRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Bearbeiter::class);
    }

    public function findByName(string $name): ?Bearbeiter
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.bearbeiter_name = :name')
            ->setParameter('name', $name)
            ->getQuery()
            ->getOneOrNullResult();
    }

    public function findByTerm(string $term): array
    {
        return $this->createQueryBuilder('b')
            ->where('b.bearbeiter_name LIKE :term')
            ->setParameter('term', '%' . $term . '%')
            ->getQuery()
            ->getResult();
    }
}
