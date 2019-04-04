<?php

namespace App\Repository;

use App\Entity\MessageTache;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method MessageTache|null find($id, $lockMode = null, $lockVersion = null)
 * @method MessageTache|null findOneBy(array $criteria, array $orderBy = null)
 * @method MessageTache[]    findAll()
 * @method MessageTache[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MessagetacheRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, MessageTache::class);
    }

    // /**
    //  * @return MessageTache[] Returns an array of MessageTache objects
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
    public function findOneBySomeField($value): ?MessageTache
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
