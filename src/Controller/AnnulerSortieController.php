<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AnnulerSortieController extends AbstractController
{
    /**
     * @Route("/annuler/sortie", name="annuler_sortie")
     */
    public function index(): Response
    {
        return $this->render('annuler_sortie/index.html.twig', [
            'controller_name' => 'AnnulerSortieController',
        ]);
    }
}
