<?php

namespace App\Repository;

use App\Entity\Autohypnose;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Autohypnose|null find($id, $lockMode = null, $lockVersion = null)
 * @method Autohypnose|null findOneBy(array $criteria, array $orderBy = null)
 * @method Autohypnose[]    findAll()
 * @method Autohypnose[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AutohypnoseRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Autohypnose::class);
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function add(Autohypnose $entity, bool $flush = true): void
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
    public function remove(Autohypnose $entity, bool $flush = true): void
    {
        $this->_em->remove($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

    /**
     * @return Autohypnose[] 
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
    //  * @return Autohypnose[] Returns an array of Autohypnose objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('a.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Autohypnose
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
