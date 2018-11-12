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
