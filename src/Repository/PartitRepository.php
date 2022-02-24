<?php

namespace App\Repository;

use App\Entity\Partit;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\ORM\EntityManagerInterface;


/**
 * @method Partit|null find($id, $lockMode = null, $lockVersion = null)
 * @method Partit|null findOneBy(array $criteria, array $orderBy = null)
 * @method Partit[]    findAll()
 * @method Partit[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PartitRepository extends ServiceEntityRepository
{
    private $manager;

    public function __construct
    (
        ManagerRegistry $registry,
        EntityManagerInterface $manager
    )
    {
        parent::__construct($registry, Partit::class);
        $this->manager = $manager;
    }

    public function savePartit($id, $gols, $assist, $xuts_porta, $xuts_fora, $perdues, $recuperacions, $intercepcions)
    {
        $newPartit = new Partit();

        $newPartit
            ->setId($id)
            ->setGols($gols)
            ->setAssist($assist)
            ->setXutsPorta($xuts_porta)
            ->setXutsFora($xuts_fora)
            ->setPerdues($perdues)
            ->setRecuperacions($recuperacions)
            ->setIntercepcions($intercepcions);

        $this->manager->persist($newPartit);
        $this->manager->flush();
    }

    public function updatePartit(Partit $partit): Partit
    {
        $this->manager->persist($partit);
        $this->manager->flush();

        return $partit;
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
