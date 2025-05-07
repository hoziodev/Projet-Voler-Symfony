<?php

namespace App\Form;

use App\Controller\UserController;
use App\Entity\Avion;
use App\Entity\User;
use App\Entity\Vol;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\QueryBuilder;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class VolForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('villeDepart')
            ->add('villeArrive')
            ->add('dateDepart')
            ->add('prixBilletInitiale')
            ->add('heureDepart')
            ->add('refAvion', EntityType::class, [
                'class' => Avion::class,
                'choice_label' => 'nom',
            ])
            ->add('refPilote', EntityType::class, [
                    "class" => User::class,
                    'query_builder' => function (EntityRepository $er) {
                        return $er->createQueryBuilder('u')
                            ->where('u.roles LIKE :roles')
                            ->setparameter('roles', '%"ROLE_PILOTE"%');
                    },
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Vol::class,
        ]);
    }
}
