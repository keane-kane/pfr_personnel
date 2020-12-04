<?php

namespace App\Repository;

use App\Entity\GroupTags;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method GroupTags|null find($id, $lockMode = null, $lockVersion = null)
 * @method GroupTags|null findOneBy(array $criteria, array $orderBy = null)
 * @method GroupTags[]    findAll()
 * @method GroupTags[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class GroupTagsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, GroupTags::class);
    }

    // /**
    //  * @return GroupTags[] Returns an array of GroupTags objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('g')
            ->andWhere('g.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('g.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?GroupTags
    {
        return $this->createQueryBuilder('g')
            ->andWhere('g.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
