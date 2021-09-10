<?php

namespace App\Controller;


use http\Env\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class AccueilController extends AbstractController
{
    /**
     * Class AccueilController
     * @package AppController
     * @Route("/accueil", name="accueil")
     */
    public function index(ParticipantRepository $participantRepository)
    {
//        $repository = $this->getDoctrine()->getRepository(Participant::class);
//        $participant = $repository->findOneBy(
//            'nom');
        $p1=$participantRepository->findOneBy([
            'nom'
        ]);

        return $this->render('accueil/index.html.twig', [
            'controller_name' => 'AccueilController',
          'participant'=>$p1,


        ]);
    }

}
