<?php

namespace App\Form;

use App\Entity\Avion;
use App\Entity\User;
use App\Entity\Vol;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class VolTypeForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('villeDepart')
            ->add('villeArrive')
            ->add('dateDepart')
            ->add('heureDepart')
            ->add('prixBilletInitiale')
            ->add('refAvion', EntityType::class, [
                'class' => Avion::class,
                'choice_label' => 'id',
            ])
            ->add('refPilote', EntityType::class, [
                'class' => User::class,
                'choice_label' => 'id',
            ])
            ->add('submit', SubmitType::class, ['label' => "Enregistrer"])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Vol::class,
        ]);
    }
}
