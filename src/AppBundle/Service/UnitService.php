<?php

namespace AppBundle\Service;

use AppBundle\Entity\Unit;
use Doctrine\ORM\EntityManagerInterface;

class UnitService
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function getUnitList()
    {
        return $this->entityManager->getRepository(Unit::class)
            ->getAllUnitNames();
    }

    public function findUnitByName($unitName)
    {
        return $this->entityManager->getRepository(Unit::class)
            ->findOneBy([
                'name' => $unitName
            ]);
    }
}