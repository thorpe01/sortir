<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CréerSortieController extends AbstractController
{
    /**
     * @Route("/cr/er/sortie", name="cr_er_sortie")
     */
    public function index(): Response
    {
        return $this->render('cr�er_sortie/index.html.twig', [
            'controller_name' => 'CréerSortieController',
        ]);
    }
}
