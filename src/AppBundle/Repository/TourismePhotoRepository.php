<?php

namespace AppBundle\Repository;

/**
 * TourismePhotoRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class TourismePhotoRepository extends \Doctrine\ORM\EntityRepository
{
    /**
     * Liste des photos par ordre decroissant
     */
    public function findListDesc()
    {
        return $this->createQueryBuilder('t')
                    ->orderBy('t.id', 'DESC')
                    ->getQuery()->getResult()
            ;
    }
}