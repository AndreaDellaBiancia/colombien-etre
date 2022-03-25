<?php

namespace App\Repository;

use App\Entity\Massage;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Massage|null find($id, $lockMode = null, $lockVersion = null)
 * @method Massage|null findOneBy(array $criteria, array $orderBy = null)
 * @method Massage[]    findAll()
 * @method Massage[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MassageRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Massage::class);
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function add(Massage $entity, bool $flush = true): void
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
    public function remove(Massage $entity, bool $flush = true): void
    {
        $this->_em->remove($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

    /**
     * @return Massage[] 
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
    //  * @return Massage[] Returns an array of Massage objects
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
    public function findOneBySomeField($value): ?Massage
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
