<?php

namespace App\Repository;

use App\Entity\Jugador;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\ORM\EntityManagerInterface;

/**
 * @method Jugador|null find($id, $lockMode = null, $lockVersion = null)
 * @method Jugador|null findOneBy(array $criteria, array $orderBy = null)
 * @method Jugador[]    findAll()
 * @method Jugador[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class JugadorRepository extends ServiceEntityRepository
{
    private $manager;

    public function __construct
    (
        ManagerRegistry $registry,
        EntityManagerInterface $manager
    )
    {
        parent::__construct($registry, Jugador::class);
        $this->manager = $manager;
    }

    public function saveJugador($id, $gols, $assist, $xuts_porta, $xuts_fora, $perdues, $recuperacions, $intercepcions, $partits)
    {
        $newJugador = new Jugador();

        $newJugador
            ->setId($id)
            ->setGols($gols)
            ->setAssist($assist)
            ->setXutsPorta($xuts_porta)
            ->setXutsFora($xuts_fora)
            ->setPerdues($perdues)
            ->setRecuperacions($recuperacions)
            ->setIntercepcions($intercepcions)
            ->setPartits($partits);

        $this->manager->persist($newJugador);
        $this->manager->flush();
    }

    // /**
    //  * @return Jugador[] Returns an array of Jugador objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Jugador
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
