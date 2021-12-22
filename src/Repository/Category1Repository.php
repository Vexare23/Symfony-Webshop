<?php

namespace App\Repository;

use App\Entity\Category1;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Category1|null find($id, $lockMode = null, $lockVersion = null)
 * @method Category1|null findOneBy(array $criteria, array $orderBy = null)
 * @method Category1[]    findAll()
 * @method Category1[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class Category1Repository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Category1::class);
    }

    // /**
    //  * @return Category1[] Returns an array of Category1 objects
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
    public function findOneBySomeField($value): ?Category1
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
