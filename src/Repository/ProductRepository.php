<?php

namespace App\Repository;

use App\Entity\Product;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Product|null find($id, $lockMode = null, $lockVersion = null)
 * @method Product|null findOneBy(array $criteria, array $orderBy = null)
 * @method Product[]    findAll()
 * @method Product[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProductRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Product::class);
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function add(Product $entity, bool $flush = true): void
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
    public function remove(Product $entity, bool $flush = true): void
    {
        $this->_em->remove($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

    /**
     * @return Product[] Returns an array of Product objects
     */
    public function findAllBySearchTerm($searchTerm)
    {
        return
            $this->createQueryBuilder('product')

            // WHERE title LIKE searchTerm
            ->andWhere('product.category LIKE :searchTerm')
            ->orWhere('product.title LIKE :searchTerm')
            ->orWhere('product.brand LIKE :searchTerm')
            ->setParameter(':searchTerm', "%$searchTerm%")

            ->getQuery()
            ->getResult();
    }

    /**
     * @return Product[] Returns an array of Product objects
     */
    public function findAllBycheckbox($searchTerms)
    {
        // Je crée un tableau vide pour recuperer les resultats
        $results = [];

        //Je recupere la liste des checkbox coché (searchTerms) 
        //et pour chaque checkbox(searchTerm) je fais une recherce sur la table produit
        foreach ($searchTerms as $searchTerm) {

            //Je stocke dans le tableau $result les differentes listes des produits qui correspondent aux checkbox
            $results[] = $this->createQueryBuilder('product')


                ->andWhere('product.category LIKE :searchTerm')
                ->orWhere('product.title LIKE :searchTerm')
                ->orWhere('product.brand LIKE :searchTerm')
                ->setParameter(':searchTerm', "%$searchTerm%")

                ->getQuery()
                ->getResult();
        }
        return $results;
    }
}
