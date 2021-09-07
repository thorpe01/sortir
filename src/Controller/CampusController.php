<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
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
    public function create(): Response
    {
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
    public function delete(): Response
    {
        return $this->render('campus/delete.html.twig', [
        ]);
    }
}
