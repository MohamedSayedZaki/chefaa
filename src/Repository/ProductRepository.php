<?php

namespace App\Repository;

use App\Entity\Product;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

/**
 * @extends ServiceEntityRepository<Product>
 *
 * @method Product|null find($id, $lockMode = null, $lockVersion = null)
 * @method Product|null findOneBy(array $criteria, array $orderBy = null)
 * @method Product[]    findAll()
 * @method Product[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProductRepository extends ServiceEntityRepository
{
    private $entityManager;

    public function __construct(ManagerRegistry $registry,EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
        parent::__construct($registry, Product::class);
    }

    public function findAllWithSearch($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.title like :val')
            ->setParameter('val', '%'.$value.'%')
            ->setMaxResults(20)
            ->getQuery()
            ->getResult();
    }

    public function findProducts($value)
    {
        $query = $this->entityManager->createQuery('SELECT p,pp,ph
        FROM App\Entity\ProdctPharmacy pp
        JOIN pp.product p JOIN pp.pharmacy ph
        where p.id=:val');        
        $query->setParameter('val', $value);
        return $query->getResult();
    }

    public function getCheapestPharmacies($id){
        $query = $this->entityManager->createQuery('SELECT p,pp,ph
        FROM App\Entity\ProdctPharmacy pp
        JOIN pp.product p JOIN pp.pharmacy ph
        where p.id=:val 
        ORDER BY pp.price ASC
        ');        
        $query->setParameter('val', $id);
        $query->setMaxResults(5);
        return $query->getResult();
    }
}
