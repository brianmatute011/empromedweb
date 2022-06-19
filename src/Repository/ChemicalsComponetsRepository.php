<?php

namespace App\Repository;

use App\Entity\ChemicalsComponets;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<ChemicalsComponets>
 *
 * @method ChemicalsComponets|null find($id, $lockMode = null, $lockVersion = null)
 * @method ChemicalsComponets|null findOneBy(array $criteria, array $orderBy = null)
 * @method ChemicalsComponets[]    findAll()
 * @method ChemicalsComponets[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ChemicalsComponetsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ChemicalsComponets::class);
    }

    public function add(ChemicalsComponets $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(ChemicalsComponets $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return ChemicalsComponets[] Returns an array of ChemicalsComponets objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('c.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?ChemicalsComponets
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
