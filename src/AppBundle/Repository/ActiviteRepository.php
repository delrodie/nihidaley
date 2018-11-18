<?php

namespace AppBundle\Repository;

/**
 * ActiviteRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class ActiviteRepository extends \Doctrine\ORM\EntityRepository
{
    /*
     * Liste des activités
     */
    public function findList($statut = null, $limit = null, $offset = null)
    {
        return $this->listDesc()->getQuery()->getResult();
    }

    /**
     * Liste des activites par jour
     */
    public function findByDay($day = null)
    {
        return $this->listDesc()->where('a.date = :day')
                                ->setParameter('day', '2018-12-'.$day)
                                ->getQuery()->getResult()
            ;
    }

    /*
     * Liste des activités par ordres croissant de date
     */
    public function listDesc()
    {
        return $this->createQueryBuilder('a')
                    ->orderBy('a.date', 'ASC')
                    ->addOrderBy('a.heuredeb', 'ASC')
            ;
    }
}
