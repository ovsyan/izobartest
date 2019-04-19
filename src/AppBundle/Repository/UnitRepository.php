<?php

namespace AppBundle\Repository;

use Doctrine\ORM\EntityRepository;

class UnitRepository extends EntityRepository
{

    public function getAllUnitNames()
    {
        return $this->getEntityManager()
            ->createQuery(
                'SELECT u.name FROM AppBundle:Unit u ORDER BY u.name ASC'
            )
            ->getResult();
    }
}