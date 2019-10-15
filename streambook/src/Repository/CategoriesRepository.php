<?php

namespace App\Repository;

use App\Entity\categories;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method categories|null find($id, $lockMode = null, $lockVersion = null)
 * @method categories|null findOneBy(array $criteria, array $orderBy = null)
 * @method categories[]    findAll()
 * @method categories[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CategoriesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, categories::class);
    }

    // /**
    //  * @return categories[] Returns an array of categories objects
    //  */

    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.categories = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }

    public function findOneByIdJoinedToBooks($book)
    {
        return $this->createQueryBuilder('c')
            ->innerJoin('c.books', 'cb')
            ->andWhere('cb.id = :id')
            ->setParameter('id', $book)
            ->getQuery()
            ->getOneOrNullResult();
    }

    public function findOneBySomeField($value): ?categories
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.categories = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }

}
