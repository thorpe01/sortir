<?php

namespace App\Controller;

use App\Repository\CampusRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CampusController extends AbstractController
{
    /**
     * Class CampusController
     * @package AppController
     * @Route("/campus", name="campus")
     */
    public function index(CampusRepository $campusRepository): Response
    {
        $campus = $campusRepository->findAll();
        return $this->render('campus/index.html.twig', [
            'campus' => $campus,
        ]);
    }
}
