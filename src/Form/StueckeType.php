<?php

namespace App\Form;

use App\Entity\Stuecke;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class StueckeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, [
                'label' => 'Name des Stücks',
                'required' => true
            ])
            ->add('stueck_art', ChoiceType::class, [
                'choices' => [
                    'Marsch' => 'Marsch',
                    'Konzert' => 'Konzert',
                ],
                'label' => 'Art des Stücks',
                'required' => true
            ])
            ->add('anschaffungsdatum', DateType::class, [
                'widget' => 'single_text',
                'label' => 'Anschaffungsdatum',
                'required' => true
            ])
            ->add('jugendzug_stueck', CheckboxType::class, [
                'label' => 'Jugendzug Stück?',
                'required' => false
            ])
            ->add('interpreter_name', TextType::class, [
                'label' => 'Interpreter',
                'required' => false,
                'mapped' => false,
                'attr' => [
                    'class' => 'interpreter-autocomplete',
                    'placeholder' => 'Interpreter eingeben...'
                ]
            ])
            ->add('bearbeiter_name', TextType::class, [
                'label' => 'Bearbeiter',
                'required' => false,
                'mapped' => false,
                'attr' => [
                    'class' => 'bearbeiter-autocomplete',
                    'placeholder' => 'Bearbeiter eingeben...'
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Stuecke::class
        ]);
    }
}