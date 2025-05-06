<?php

namespace App\Form;

use App\Entity\Modele;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserTypeForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email', EmailType::class, [
                'attr' => [
                    'class' => 'form-control',
                ],
                'label' => 'Entrer votre email',
                'label_attr' => [
                    'class' => 'form-label',
                ]
            ])
            ->add('password', RepeatedType::class, [
                'type' => PasswordType::class,
                'first_options'  => [
                    'attr' => [
                        'class' => 'mb-3 form-control fakepassword',
                    ],
                    'label' => 'Mot de passe',
                    'label_attr' => [
                        'class' => 'form-label',
                    ]
                ],
                'attr' => ['class' => 'mb-3'],
                'second_options' => [
                    'attr' => [
                      'class' => 'form-control',
                    ],
                    'label' => 'Confirmation mot de passe',
                    'label_attr' => [
                        'class' => 'form-label',
                    ],
                ],
                'invalid_message' => 'Les mots de passe ne correspondent pas.',
                'mapped' => false,
            ])
            ->add('nom', TextType::class, [
                'attr' => [
                'class' => 'form-control',
            ],
                'label' => 'Votre Nom',
                'label_attr' => [
                    'class' => 'form-label',
                ]
            ])

            ->add('prenom', TextType::class, [
                'attr' => [
                    'class' => 'form-control',
                ],
                'label' => 'Votre Prenom',
                'label_attr' => [
                    'class' => 'form-label',
                ]
            ])
            ->add('dateNaissance', DateType::class, [
                'attr' => [
                    'class' => 'form-control',
                ],
                'label' => 'Votre Date de Naissance',
                'label_attr' => [
                    'class' => 'form-label',
                ]
            ])
            ->add('ville', TextType::class, [
                'attr' => [
                    'class' => 'form-control',
                ],
                'label' => 'Votre Ville',
                'label_attr' => [
                    'class' => 'form-label',
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
