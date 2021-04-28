<?php

namespace App\Repository;

use App\Entity\Catalogage;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Catalogage|null find($id, $lockMode = null, $lockVersion = null)
 * @method Catalogage|null findOneBy(array $criteria, array $orderBy = null)
 * @method Catalogage[]    findAll()
 * @method Catalogage[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CatalogageRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Catalogage::class);
    }

    // /**
    //  * @return Catalogage[] Returns an array of Catalogage objects
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
    public function findOneBySomeField($value): ?Catalogage
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
