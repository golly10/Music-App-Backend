<?php

namespace App\Repository;

use App\Entity\Mediatype;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Mediatype|null find($id, $lockMode = null, $lockVersion = null)
 * @method Mediatype|null findOneBy(array $criteria, array $orderBy = null)
 * @method Mediatype[]    findAll()
 * @method Mediatype[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MediatypeRepo extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Mediatype::class);
    }

    // /**
    //  * @return Mediatype[] Returns an array of Mediatype objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('m.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Mediatype
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
