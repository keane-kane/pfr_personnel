<?php

namespace App\Repository;

use App\Entity\EtatBriefGroup;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method EtatBriefGroup|null find($id, $lockMode = null, $lockVersion = null)
 * @method EtatBriefGroup|null findOneBy(array $criteria, array $orderBy = null)
 * @method EtatBriefGroup[]    findAll()
 * @method EtatBriefGroup[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EtatBriefGroupRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, EtatBriefGroup::class);
    }

    // /**
    //  * @return EtatBriefGroup[] Returns an array of EtatBriefGroup objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('e.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?EtatBriefGroup
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
