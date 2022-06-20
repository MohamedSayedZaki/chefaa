<?php

namespace App\Repository;

use App\Entity\ProdctPharmacy;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<ProdctPharmacy>
 *
 * @method ProdctPharmacy|null find($id, $lockMode = null, $lockVersion = null)
 * @method ProdctPharmacy|null findOneBy(array $criteria, array $orderBy = null)
 * @method ProdctPharmacy[]    findAll()
 * @method ProdctPharmacy[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProdctPharmacyRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ProdctPharmacy::class);
    }

    public function add(ProdctPharmacy $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(ProdctPharmacy $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return ProdctPharmacy[] Returns an array of ProdctPharmacy objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('p.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?ProdctPharmacy
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
