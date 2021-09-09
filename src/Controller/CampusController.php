<?php

namespace App\Controller;

use App\Repository\CampusRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CampusController extends AbstractController
{
    /**
     * @Route("/campus", name="campus")
     */
    public function index(CampusRepository $campusRepository): Response
    {
        $campus = $campusRepository->findAll();
        if (!$campus) {
            throw $this->createNotFoundException('not found');
        }
        return $this->render('afficher/index.html.twig', [
            'campus' => 'CampusController',
        ]);
    }
}
