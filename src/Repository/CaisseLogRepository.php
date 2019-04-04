<?php

namespace App\Repository;

use App\Entity\CaisseLog;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method CaisseLog|null find($id, $lockMode = null, $lockVersion = null)
 * @method CaisseLog|null findOneBy(array $criteria, array $orderBy = null)
 * @method CaisseLog[]    findAll()
 * @method CaisseLog[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CaisseLogRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, CaisseLog::class);
    }

    // /**
    //  * @return CaisseLog[] Returns an array of CaisseLog objects
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

    public function getlogbydate($date1,$date2)
    {
        
        $qb = $this->createQueryBuilder('c')
        ->select('Sum(c)')
        ->where('c.date BETWEEN :firstDate AND :lastDate')
        ->setParameter('firstDate', $date1)
        ->setParameter('lastDate', $date2)
    ;
    return $qb->getQuery()->getResult();


    }


    /*
    public function findOneBySomeField($value): ?CaisseLog
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
