<?php

namespace App\Controller;

use App\Entity\Campus;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CampusController extends AbstractController
{
    /**
     * @Route("/campus", name="campus")
     */
    public function index(): Response
    {
        return $this->render('campus/index.html.twig', [
        ]);
    }

    /**
     * @Route("/campus/create", name="campus_create")
     */
    public function create(Request $request, EntityManagerInterface $entityManager): Response
    {
        $campus = new Campus();
        return $this->render('campus/create.html.twig', [
        ]);
    }

    /**
     * @Route("/campus/update", name="campus_update")
     */
    public function update(): Response
    {
        return $this->render('campus/update.html.twig', [
        ]);
    }

    /**
     * @Route("/campus/delete", name="campus_delete")
     */
    public function delete(Campus $campus, EntityManagerInterface $entityManager): Response
    {
        $entityManager->remove($campus);
        $entityManager->flush();
        return $this->render('campus/delete.html.twig', [
        ]);
    }
}
