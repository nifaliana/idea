<?php

namespace App\Repository;

use App\Entity\Panneau;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Panneau|null find($id, $lockMode = null, $lockVersion = null)
 * @method Panneau|null findOneBy(array $criteria, array $orderBy = null)
 * @method Panneau[]    findAll()
 * @method Panneau[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PanneauRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Panneau::class);
    }

    // /**
    //  * @return Panneau[] Returns an array of Panneau objects
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
    public function findOneBySomeField($value): ?Panneau
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
