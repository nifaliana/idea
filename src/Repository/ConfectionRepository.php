<?php

namespace App\Repository;

use App\Entity\Confection;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Confection|null find($id, $lockMode = null, $lockVersion = null)
 * @method Confection|null findOneBy(array $criteria, array $orderBy = null)
 * @method Confection[]    findAll()
 * @method Confection[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ConfectionRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Confection::class);
    }

    // /**
    //  * @return Confection[] Returns an array of Confection objects
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
    public function findOneBySomeField($value): ?Confection
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
