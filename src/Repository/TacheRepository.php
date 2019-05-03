<?php

namespace App\Repository;

use App\Entity\Tache;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\NonUniqueResultException;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Tache|null find($id, $lockMode = null, $lockVersion = null)
 * @method Tache|null findOneBy(array $criteria, array $orderBy = null)
 * @method Tache[]    findAll()
 * @method Tache[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TacheRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Tache::class);
    }
    public function findAllWithIdStartEndProperties()
    {
        return $this->createQueryBuilder('t')
                ->select('t.id AS id,t.nomtache AS title,t.datedebut as start,t.datefin AS end')
                ->getQuery()
                ->getResult();

    }
    // /**
    //  * @return Tache[] Returns an array of Tache objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('t.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */


    public function findOneById($value): ?Tache
    {

            return $this->createQueryBuilder('t')
                ->andWhere('t.id = :val')
                ->setParameter('val', $value)
                ->getQuery()
                ->getOneOrNullResult();
    }

}
