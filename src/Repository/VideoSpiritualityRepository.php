<?php

namespace App\Repository;

use App\Entity\VideoSpirituality;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method VideoSpirituality|null find($id, $lockMode = null, $lockVersion = null)
 * @method VideoSpirituality|null findOneBy(array $criteria, array $orderBy = null)
 * @method VideoSpirituality[]    findAll()
 * @method VideoSpirituality[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class VideoSpiritualityRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, VideoSpirituality::class);
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function add(VideoSpirituality $entity, bool $flush = true): void
    {
        $this->_em->persist($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function remove(VideoSpirituality $entity, bool $flush = true): void
    {
        $this->_em->remove($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

    // /**
    //  * @return VideoSpirituality[] Returns an array of VideoSpirituality objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('v')
            ->andWhere('v.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('v.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?VideoSpirituality
    {
        return $this->createQueryBuilder('v')
            ->andWhere('v.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
