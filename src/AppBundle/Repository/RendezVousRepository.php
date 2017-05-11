<?php

namespace AppBundle\Repository;

use Doctrine\ORM\EntityRepository;

/**
 * RendezVousRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class RendezVousRepository extends EntityRepository
{

    public function getAllLapinNotComingToFirstRdv(String $especeNom)
    {
        return $this->createQueryBuilder('rdv')
            ->join('rdv.client', 'c')
            ->join('c.espece', 'e')
            ->where('e.nom = :nom')
            ->andWhere('rdv.isComing = :isComing')
            ->orderBy('rdv.date', 'ASC')
            ->setParameter('nom',$especeNom)
            ->setParameter('isComing',false)
            ->getQuery()
            ->getResult();
    }
}
