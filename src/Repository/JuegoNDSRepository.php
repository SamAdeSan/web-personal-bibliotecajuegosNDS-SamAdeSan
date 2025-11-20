<?php

namespace App\Repository;

use App\Entity\JuegoNDS;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<JuegoNDS>
 */
class JuegoNDSRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, JuegoNDS::class);
    }

    public function findByName($text): array
    {
        $entityManager = $this->getEntityManager();
        $query = $entityManager->createQuery(
            'SELECT j FROM App\Entity\JuegoNDS j WHERE j.nombre LIKE :text'
        )->setParameter('text', '%' . $text . '%');

        return $query->execute();
    }

    public function findByGenero($genero): array
    {
        $qb = $this->createQueryBuilder('j')
            ->andWhere('j.genero = :genero')
            ->setParameter('genero', $genero)
            ->getQuery();
        return $qb->execute();
    }

    public function findByFechaLanzamiento($fecha): array
    {
        $qb = $this->createQueryBuilder('j')
            ->andWhere('j.edad > :fecha')
            ->setParameter('fecha', $fecha)
            ->getQuery();
        return $qb->execute();
    }

    //    /**
    //     * @return JuegoNDS[] Returns an array of JuegoNDS objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('j')
    //            ->andWhere('j.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('j.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?JuegoNDS
    //    {
    //        return $this->createQueryBuilder('j')
    //            ->andWhere('j.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
