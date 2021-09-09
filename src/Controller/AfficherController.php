<?php

namespace App\Controller;

use App\Entity\Participant;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class AfficherController extends AbstractController
{

    /**
     * @Route("/afficher/{participant}", name="afficher")
     */
    public function index(Participant $participant): Response
    {

        return $this->render('afficher/index.html.twig', [
            "participant" => $participant,
        ]);
    }
}



