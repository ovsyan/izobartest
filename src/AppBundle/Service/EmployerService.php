<?php

namespace AppBundle\Service;

use Doctrine\ORM\EntityManagerInterface;
use AppBundle\Entity\Employer;

class EmployerService
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function getEmployersByUnit($unitName)
    {
        return $this->entityManager->getRepository(Employer::class)
            ->getEmployersByUnitName($unitName);
    }

    public function getEmployerInfoByFullName($lastName, $firstName)
    {
        return $this->entityManager->getRepository(Employer::class)
            ->getEmployerInfoByFullName($lastName, $firstName);
    }
}