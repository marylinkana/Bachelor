<?php

namespace App\Repository;

use App\Entity\Books;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Books|null find($id, $lockMode = null, $lockVersion = null)
 * @method Books|null findOneBy(array $criteria, array $orderBy = null)
 * @method Books[]    findAll()
 * @method Books[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BooksRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Books::class);
    }

     /**
      * @return Books[] Returns an array of Books objects
      */
    public function findByTitleField($value)
    {
        return $this->createQueryBuilder('b')
            ->Where('b.title = :val')
            ->setParameter('val', $value)
            ->orderBy('b.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }

    public function findByIdJoinedToCategory($cat)
    {
        return $this->createQueryBuilder('b')
            ->select('b')
            ->innerJoin('b.category', 'bc')
            ->Where('bc.id = :id')
            ->setParameter('id', $cat)
            ->orderBy('b.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }


    public function findLikeExampleField($value)
    {
        return $this->createQueryBuilder('b')
            ->orWhere('b.title like :val')
            ->orWhere('b.author like :val')
            ->orWhere('b.description like :val')
            ->setParameter('val', '%'.$value.'%')
            ->orderBy('b.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
            ;
    }

    public function findOneByIdField($id): ?Books
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.id = :val')
            ->setParameter('val', $id)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
}
