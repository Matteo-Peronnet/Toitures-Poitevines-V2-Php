<?php

namespace BackOfficeBundle\Repository;

/**
 * CategorieRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class CategorieRepository extends \Doctrine\ORM\EntityRepository
{
    public function getMaxPlacementCategorie(){
        return $this->createQueryBuilder('c')
            ->select('MAX(c.placement)')
            ->getQuery()->getSingleResult();
    }
}
