<?php

namespace App\Repository;

use App\Entity\ProductReviews;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method ProductReviews|null find($id, $lockMode = null, $lockVersion = null)
 * @method ProductReviews|null findOneBy(array $criteria, array $orderBy = null)
 * @method ProductReviews[]    findAll()
 * @method ProductReviews[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProductReviewsRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, ProductReviews::class);
    }

    // /**
    //  * @return ProductReviews[] Returns an array of ProductReviews objects
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
    public function findOneBySomeField($value): ?ProductReviews
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
