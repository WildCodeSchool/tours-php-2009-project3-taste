<?php

namespace App\Form;

use App\Entity\Caterer;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CatererType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('lastname', TextType::class, [
                'label' => 'Nom',
                'attr' => ['class' => 'name']
            ])
            ->add('firstname', TextType::class, [
                'label' => 'Prénom',
                'attr' => ['class' => 'firstname']
            ])
            ->add('email', EmailType::class, [
                'label' => 'Email',
                'attr' => ['class' => 'email']
            ])
            ->add('number', TelType::class, [
                'label' => 'Téléphone',
                'attr' => ['class' => 'tel']
            ])
            ->add('budget', TextType::class, [
                'label' => 'Budget',
                'attr' => ['class' => 'budget']
            ])
            ->add('date', DateType::class, [
                'widget' => 'single_text',
                'attr' => ['class' => 'date'],
            ])
            ->add('location', TextType::class, [
                'label' => 'Localisation',
                'attr' => ['class' => 'local']
            ])
            ->add('guests', TextType::class, [
                'label' => 'Nombre d\'invités',
                'attr' => ['class' => 'guests']
            ])
            ->add('description', TextareaType::class, [
                'label' => 'Description de l\'évenement',
                'attr' => ['class' => 'description', 'rows' => 10]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Caterer::class,
        ]);
    }
}
