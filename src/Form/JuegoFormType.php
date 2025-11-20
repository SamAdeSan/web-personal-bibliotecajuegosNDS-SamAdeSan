<?php

namespace App\Form;

use App\Entity\Biblioteca;
use App\Entity\JuegoNDS;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class JuegoFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nombre')
            ->add('genero')
            ->add('fechaLanzamiento')
            ->add('biblioteca', EntityType::class, [
                'class' => Biblioteca::class,
                'choice_label' => 'id',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => JuegoNDS::class,
        ]);
    }
}
