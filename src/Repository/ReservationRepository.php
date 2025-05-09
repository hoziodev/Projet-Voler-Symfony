<?php

namespace App\Repository;

use App\Entity\Reservation;
use App\Entity\Vol;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Reservation>
 */
class ReservationRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Reservation::class);
    }

    //    /**
    //     * @return Reservation[] Returns an array of Reservation objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('r')
    //            ->andWhere('r.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('r.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?Reservation
    //    {
    //        return $this->createQueryBuilder('r')
    //            ->andWhere('r.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }

    public function ajustementPrixBillet(Reservation $reservation , Vol $vol): void
    {
        $date = $reservation -> getRefVol() ->getDateDepart() ;
        $now = new \DateTime();
        $prix = $vol->getPrixBilletInitiale();
        $joursRestants = $date->diff($now);
        $joursRestants = $joursRestants->days;
        if($joursRestants <= 2){
            $reservation ->setPrixBillet($prix *1.5);
        }
        else if($joursRestants <= 10){
            $reservation ->setPrixBillet($prix *1.25);
        }
        else if ($joursRestants <=20){
            $reservation ->setPrixBillet($prix *1.10);
        }
        else {
            $reservation ->setPrixBillet($prix *1.05);
        }
    }
}
