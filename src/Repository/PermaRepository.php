<?php

namespace App\Repository;

use App\Entity\Perma;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Perma|null find($id, $lockMode = null, $lockVersion = null)
 * @method Perma|null findOneBy(array $criteria, array $orderBy = null)
 * @method Perma[]    findAll()
 * @method Perma[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PermaRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Perma::class);
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function add(Perma $entity, bool $flush = true): void
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
    public function remove(Perma $entity, bool $flush = true): void
    {
        $this->_em->remove($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

    /**
     * @return Perma[] 
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
    //  * @return Perma[] Returns an array of Perma objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Perma
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
