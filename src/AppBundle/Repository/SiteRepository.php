<?php

namespace AppBundle\Repository;

/**
 * SiteRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class SiteRepository extends \Doctrine\ORM\EntityRepository
{
    /*
     * Liste par ordre alphabetique
     */
    public function FindList()
    {
        return $this->createQueryBuilder('s')
                    ->orderBy('s.libelle', 'ASC')
                    //->getQuery()->getResult()
            ;
    }
}
