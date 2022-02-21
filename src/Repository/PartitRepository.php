<?php

namespace App\Repository;

use App\Entity\Partit;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Partit|null find($id, $lockMode = null, $lockVersion = null)
 * @method Partit|null findOneBy(array $criteria, array $orderBy = null)
 * @method Partit[]    findAll()
 * @method Partit[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PartitRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Partit::class);
    }

    // /**
    //  * @return Partit[] Returns an array of Partit objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Partit
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
