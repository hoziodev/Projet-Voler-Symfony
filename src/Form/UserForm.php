<?php

namespace App\Form;

use App\Entity\Modele;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email')
            ->add('roles',ChoiceType::class, [
                'multiple' => true,
                'expanded' => true,
                'choices'  => [
                    'Admin' => 'ROLE_ADMIN',
                    'Pilote' => 'ROLE_PILOTE',
                ]
            ])
            ->add('nom')
            ->add('prenom')
            ->add('dateNaissance')
            ->add('ville')
            ->add('refModele', EntityType::class, [
                'class' => Modele::class,
                'choice_label' => 'modele',
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
