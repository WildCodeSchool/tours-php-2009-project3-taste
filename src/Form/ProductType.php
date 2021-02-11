<?php

namespace App\Form;

use App\Entity\Category;
use App\Entity\Product;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProductType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'label' => 'Nom*',
            ])
            ->add('price', MoneyType::class, [
                'label' => 'Prix*',
            ])
            ->add('ingredients', TextType::class, [
                'label' => 'Ingredients',
                'required' => false,
            ])
            ->add('groupName', ChoiceType::class, [
                'label' => 'Sous-Catégorie',
                'choices' => [
                    '' => null,
                    'Baguette' => 'Baguette',
                    'Wrap' => 'Wrap',
                    'Norvégien' => 'Norvégien',
                    'Soupe en hiver & Gaspachos en été' => 'Soupe en hiver & Gaspachos en été',
                    'Boisson sans alcool' => 'Boisson sans Alcool',
                    'Boisson alcoolisées' => 'Boisson alcoolisées',
                    'Supplément' => 'Supplément',
                    'Petites Salades composées' => 'Petites Salades composées',
                    'Grandes Salades composées' => 'Grandes Salades composées',
                ]
            ])
            ->add('groupDescription', TextType::class, [
                'label' => 'Sous-Catégorie description',
                'required' => false,
            ])
            ->add('category', EntityType::class, [
                'label' => 'Catégorie*',
                'class' => Category::class,
                'choice_label' => 'name',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Product::class,
        ]);
    }
}
