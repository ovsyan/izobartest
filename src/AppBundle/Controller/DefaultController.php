<?php

namespace AppBundle\Controller;

use AppBundle\Form\CommentType;
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

        $employer = $employerService->getEmployerInfoByFullName($lastName, $firstName);
        $commentService = $this->get('comment.service');
        $form = $this->createForm(CommentType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
            $commentService->createComment($this->getUser(), $employer, $data['content']);
        }

        return $this->render('default/employer_info.html.twig', [
            'employer' => $employer,
            'comments' => $commentService->getCommentsAboutUser($employer),
            'commentForm' => $form->createView()
        ]);
    }
}
