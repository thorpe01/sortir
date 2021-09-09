<?php

namespace App\Controller;

use App\Repository\CampusRepository;
use App\Repository\ParticipantRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class AfficherController extends AbstractController
{
    /**
     * @Route("/afficher/{id}", name="afficher")
     */
    public function index(int $id, ParticipantRepository $participantRepository): Response
    {
        $participant = $participantRepository->find($id);
        if (!$participant) {
            throw $this->createNotFoundException('not found');
        }

        return $this->render('afficher/index.html.twig', [
            "participant" => $participant,
        ]);
    }
}
