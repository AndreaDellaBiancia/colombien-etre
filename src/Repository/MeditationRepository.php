<?php

namespace App\Repository;

use App\Entity\Meditation;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Meditation|null find($id, $lockMode = null, $lockVersion = null)
 * @method Meditation|null findOneBy(array $criteria, array $orderBy = null)
 * @method Meditation[]    findAll()
 * @method Meditation[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MeditationRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Meditation::class);
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function add(Meditation $entity, bool $flush = true): void
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
    public function remove(Meditation $entity, bool $flush = true): void
    {
        $this->_em->remove($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

    /**
     * @return Meditation[] 
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
    //  * @return Meditation[] Returns an array of Meditation objects
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
    public function findOneBySomeField($value): ?Meditation
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
