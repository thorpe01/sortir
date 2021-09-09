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
use Symfony\Component\Security\Core\User\User;
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
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // encode the password
//            dump($form->get('maPhoto')->getData());die;
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
//                    dump($e);die;
                }
                $user->setMaPhoto($newFilename);
            }
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush();
            // do anything else you need here, like send an email

            return $guardHandler->authenticateUserAndHandleSuccess(
                $user,
                $request,
                $authenticator,
                'main' // firewall name in security.yaml
            );
        }

//        if ($form->isSubmitted() && $form->isValid()) {
//            // On récupère les images transmises
//            $images = $form->get('maPhoto')->getData();
//
//            // On boucle sur les images
//            foreach($images as $image){
//                // On génère un nouveau nom de fichier
//                $fichier = md5(uniqid()).'.'.$image->guessExtension();
//
//                // On copie le fichier dans le dossier uploads
//                $image->move(
//                    $this->getParameter('images_directory'),
//                    $fichier
//                );
//
//                // On crée l'image dans la base de données
//                $img = new Participant();
//                $user->setMaPhoto($img);
//            }
//
//            $entityManager = $this->getDoctrine()->getManager();
//            $entityManager->persist($user);
//            $entityManager->flush();
//
//
//        }

        return $this->render('registration/register.html.twig', [
            'registrationForm' => $form->createView(),
        ]);
    }
}
