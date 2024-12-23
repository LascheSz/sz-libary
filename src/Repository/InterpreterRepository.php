<?php

namespace App\Repository;

use App\Entity\Interpreter;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Interpreter>
 */
class InterpreterRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Interpreter::class);
    }

    public function findByName(string $name): ?Interpreter
    {
        return $this->createQueryBuilder('i')
            ->andWhere('i.interpreter_name = :name')
            ->setParameter('name', $name)
            ->getQuery()
            ->getOneOrNullResult();
    }

    public function findByTerm(string $term): array
    {
        return $this->createQueryBuilder('i')
            ->where('i.interpreter_name LIKE :term')
            ->setParameter('term', '%' . $term . '%')
            ->getQuery()
            ->getResult();
    }
}
