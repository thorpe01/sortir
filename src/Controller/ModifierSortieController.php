<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ModifierSortieController extends AbstractController
{
    /**
     * @Route("/modifier/sortie", name="modifier_sortie")
     */
    public function index(): Response
    {
        return $this->render('modifier_sortie/index.html.twig', [
            'controller_name' => 'ModifierSortieController',
        ]);
    }
}
