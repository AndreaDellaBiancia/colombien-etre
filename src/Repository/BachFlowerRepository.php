<?php

namespace App\Repository;

use App\Entity\BachFlower;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method BachFlower|null find($id, $lockMode = null, $lockVersion = null)
 * @method BachFlower|null findOneBy(array $criteria, array $orderBy = null)
 * @method BachFlower[]    findAll()
 * @method BachFlower[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BachFlowerRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, BachFlower::class);
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function add(BachFlower $entity, bool $flush = true): void
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
    public function remove(BachFlower $entity, bool $flush = true): void
    {
        $this->_em->remove($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

    /**
     * @return BachFlower[]
     */
    public function findAllBySearchTerm($searchTerm)
    {
        return
            $this->createQueryBuilder('category')

            // WHERE title LIKE searchTerm
            ->andWhere('category.title LIKE :searchTerm')
            ->orWhere('category.content LIKE :searchTerm')
            ->orWhere('category.author LIKE :searchTerm')
            ->setParameter(':searchTerm', "%$searchTerm%")

            ->getQuery()
            ->getResult();
    }

    // /**
    //  * @return BachFlower[] Returns an array of BachFlower objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('b.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?BachFlower
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
