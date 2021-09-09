<?php

namespace App\Form;

use App\Entity\Campus;
use App\Entity\Participant;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class RegistrationFormType extends AbstractType
{
    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('pseudo', TextType::class)
            ->add('prenom', TextType::class)
            ->add('nom', TextType::class)
            ->add('telephone', TextType::class)
            ->add('email', EmailType::class)
            // EntityType avec sa création permet de pioché dans la table Entity
            // et de prendre les valeurs
            ->add('campus', EntityType::class, [
                'class' => Campus::class,
                'choices' => $this->entityManager->getRepository(Campus::class)->findAll(),
                'choice_label' => function (Campus $campus) {
                    return $campus->getNom();
                },

            ])
            ->add('maPhoto', FileType::class, [
                'label' => false,
                'multiple' => false,
                'mapped' => false,
                'required' => false
            ])
            ->add('agreeTerms', CheckboxType::class, [
                'mapped' => false,
                'label' => 'Règlement du campus',
                'constraints' => [
                    new IsTrue([
                        'message' => 'Veuillez accepter le règlement du campus',
                    ]),
                ],
            ])
            // RepeatedType pour pouvoir double identification
            ->add('password', RepeatedType::class, [
                // PasswordType pour le crytage
                'type' => PasswordType::class,
                'mapped' => false,
                // Label permet ici de mettre le MDP et confirmation en FR sur le formulaire
                'first_options' => ['label' => 'Mot de passe :'],
                'second_options' => ['label' => 'Confirmation :'],
                //les deux champs lorsque votre formulaire oblige l'utilisateur à saisir deux
                //fois le nouveau mot de passe comme confirmation
                'attr' => ['autocomplete' => 'new-password'],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Merci de mettre un mot de passe'
                    ]),
                    new Length([
                        'min' => 6,
                        'minMessage' => 'votre mot de passe ne contient pas assez de {{ limit }} caractère',


                    ]),
                ],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Participant::class,
        ]);
    }
}
