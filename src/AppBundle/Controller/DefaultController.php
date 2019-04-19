<?php

namespace AppBundle\Controller;

use Http\Discovery\Exception\NotFoundException;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        $unitService = $this->get('unit.service');

        return $this->render('default/index.html.twig', [
            'units' => $unitService->getUnitList()
        ]);
    }

    /**
     * @Route("/employers/{unit}", name="employers")
     */
    public function showEmployersByUnitAction($unit, Request $request)
    {
        if (!$this->get('unit.service')->findUnitByName($unit)) {
            throw new NotFoundException();
        }
        $employerService = $this->get('employer.service');

        return $this->render('default/employers.html.twig', [
            'employers' => $employerService->getEmployersByUnit($unit),
            'unit' => $unit
        ]);
    }

    /**
     * @Route("/employer/{lastName}-{firstName}", name="employer")
     */
    public function showEmployerInfoAction($lastName, $firstName, Request $request)
    {
        $employerService = $this->get('employer.service');

        if (!$employerService->getEmployerInfoByFullName($lastName, $firstName)) {
            throw new NotFoundException();
        }

        return $this->render('default/employer_info.html.twig', [
            'employer' => $employerService->getEmployerInfoByFullName($lastName, $firstName)
        ]);
    }
}
