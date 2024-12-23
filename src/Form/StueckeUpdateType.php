<?php

namespace App\Form;

use App\Entity\Bearbeiter;
use App\Entity\Interpreter;
use App\Entity\Stuecke;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class StueckeUpdateType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name')
            ->add('stueck_art')
            ->add('jugendzug_stueck')
            ->add('anschaffungsdatum', null, [
                'widget' => 'single_text',
            ])
            ->add('interpreter', EntityType::class, [
                'class' => Interpreter::class,
                'choice_label' => 'id',
            ])
            ->add('bearbeiter', EntityType::class, [
                'class' => Bearbeiter::class,
                'choice_label' => 'id',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Stuecke::class,
        ]);
    }
}
