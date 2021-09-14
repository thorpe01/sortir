<?php

namespace App\Controller;

use App\Entity\Participant;
use App\Form\RegistrationFormType;
use App\Security\AppAutenticatorAuthenticator;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Guard\GuardAuthenticatorHandler;

class RegistrationController extends AbstractController
{
    /**
     * @Route("/register", name="app_register")
     */
    public function register(Request $request, UserPasswordEncoderInterface $passwordEncoder, GuardAuthenticatorHandler $guardHandler, AppAutenticatorAuthenticator $authenticator): Response
    {
        $user = new Participant();

        $form = $this->createForm(RegistrationFormType::class, $user);
        $form->handleRequest($request); // récupere les données de la requete

        if ($form->isSubmitted() && $form->isValid()) {
            // encode the password
//            dump($form->getData());
//            dump($form->get('campus')->getData());die;
            $user->setPassword($passwordEncoder->encodePassword(
                $user,
                $form->get('password')->getData())
            );

            /** @var UploadedFile $image */
            $image = $form->get('maPhoto')->getData();
            if ($image !== null) {
                $newFilename = 'photo_utilisateur-' . uniqid() . '.' . $image->guessExtension();
                // Déplace le fichier dans le répertoire où sont stockées les photos
                try {
                    $image->move(
                        'photos/',
                        $newFilename
                    );
                } catch (FileException $e) {
//
                }
                $user->setMaPhoto($newFilename);
            }
            // pour l'insert
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush();
            // do anything else you need here, like send an email
            $this->addflash('success','le participant à bien était ajouté');
            return $this->redirectToRoute('security/login1.html.twig' );
            //return $guardHandler->authenticateUserAndHandleSuccess(
               // $user,
               // $request,
               // $authenticator,
               // 'main' // firewall name in security.yaml

        }

        return $this->render('registration/register.html.twig', [
            'registrationForm' => $form->createView(),
        ]);
    }


}
