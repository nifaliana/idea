<?php

namespace App\Repository;

use App\Entity\PanneauOffre;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method PanneauOffre|null find($id, $lockMode = null, $lockVersion = null)
 * @method PanneauOffre|null findOneBy(array $criteria, array $orderBy = null)
 * @method PanneauOffre[]    findAll()
 * @method PanneauOffre[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PanneauOffreRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PanneauOffre::class);
    }

    // /**
    //  * @return PanneauOffre[] Returns an array of PanneauOffre objects
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
    public function findOneBySomeField($value): ?PanneauOffre
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
