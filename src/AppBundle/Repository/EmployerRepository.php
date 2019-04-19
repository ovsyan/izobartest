<?php

namespace AppBundle\Repository;

use AppBundle\Entity\Employer;
use AppBundle\Entity\Unit;
use Doctrine\ORM\EntityRepository;

class EmployerRepository extends EntityRepository
{

    public function getEmployersByUnitName($unit)
    {
        return $this
            ->getEmployersByUnitNameQuery($unit)
            ->getResult();
    }

    public function getEmployersByUnitNameQuery($unit)
    {
        return $this->getEntityManager()
            ->createQueryBuilder()
            ->select('e')
            ->from('AppBundle:Employer', 'e')
            ->leftJoin('e.unit', 'u')
            ->addSelect('u')
            ->where('u.name = :unit_name')
            ->setParameter('unit_name', $unit)
            ->getQuery();
    }

    public function getEmployerInfoByFullName($lastName, $firstName)
    {
        return $this->getEntityManager()
            ->getRepository(Employer::class)
            ->findOneBy([
                'first_name' => $firstName,
                'last_name' => $lastName
            ]);
    }
}