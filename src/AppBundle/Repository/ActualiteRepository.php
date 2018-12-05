<?php

namespace AppBundle\Repository;

/**
 * ActualiteRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class ActualiteRepository extends \Doctrine\ORM\EntityRepository
{
    /**
     * Liste des actualites
     */
    public function findList($statut = null)
    {
        if ($statut){
            return $this->liste()->where('a.statut = :statut')->setParameter('statut', $statut)->getQuery()->getResult();
        }else{
            return$this->liste()->getQuery()->getResult();
        }

    }

    public function liste()
    {
        return $this->createQueryBuilder('a')
                    ->orderBy('a.date', 'DESC')
            ;
    }
}
