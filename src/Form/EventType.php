<?php

namespace App\Form;

use App\Entity\Category;
use App\Entity\Event;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EventType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('dateD', null, [
                'widget' => 'single_text',
                'attr' => ['class' => 'form-control', 'placeholder' => 'Date de début'],
                'label' => 'Date de début',
            ])
            ->add('dateF', null, [
                'widget' => 'single_text',
                'attr' => ['class' => 'form-control', 'placeholder' => 'Date de fin'],
                'label' => 'Date de fin',
            ])
            ->add('lieu', null, [
                'attr' => ['class' => 'form-control', 'placeholder' => 'Lieu de l\'événement'],
                'label' => 'Lieu',
            ])
            ->add('nom', null, [
                'attr' => ['class' => 'form-control', 'placeholder' => 'Nom de l\'événement'],
                'label' => 'Nom',
            ])
            ->add('category', EntityType::class, [
                'class' => Category::class,
                'choice_label' => 'id',
                'attr' => ['class' => 'form-control'],
                'label' => 'Catégorie',
                'placeholder' => 'Sélectionnez une catégorie',
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Event::class,
        ]);
    }
}
