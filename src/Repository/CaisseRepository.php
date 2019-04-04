<?php

namespace App\Repository;

use App\Entity\Caisse;
use App\Entity\CaisseLog;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Caisse|null find($id, $lockMode = null, $lockVersion = null)
 * @method Caisse|null findOneBy(array $criteria, array $orderBy = null)
 * @method Caisse[]    findAll()
 * @method Caisse[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CaisseRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Caisse::class);
    }

    // /**
    //  * @return Caisse[] Returns an array of Caisse objects
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
        
        $qb = $this->getEntityManager()->createQueryBuilder()
        ->select('Sum(c)')
        ->from('CaisseLog', 'c')
        ->where('c.date BETWEEN :firstDate AND :lastDate')
        ->setParameter('firstDate', $date1)
        ->setParameter('lastDate', $date2)
    ;
    return $qb->getQuery()->getResult();


    }

    /*
    public function findOneBySomeField($value): ?Caisse
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
