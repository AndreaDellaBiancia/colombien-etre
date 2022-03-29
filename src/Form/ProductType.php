<?php

namespace App\Form;

use App\Entity\Product;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;

class ProductType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title', null, [
                'label' => 'Titre*',
                'constraints' => [new NotBlank()]
            ])
            ->add('brand', null, [
                'label' => 'Marque*',
                'constraints' => [new NotBlank()]
            ])
            ->add('price', NumberType::class,[
                'label' => 'Prix €*',
                'constraints' => [new NotBlank()]
            ])
            ->add('source', null, [
                'label' => 'Source*',
                'constraints' => [new NotBlank()]
            ])
            ->add('picture', null, [
                'label' => 'Image*',
                'constraints' => [new NotBlank()]
            ])
            ->add('category', ChoiceType::class, [
                'label' => 'Categorie*',
                'constraints' => [new NotBlank()],
                'choices' => [
                    'Beauté' => 'beauté',
                    'Hygiène' => 'hygiéne',
                    'Huiles essentielles' => 'huiles-essentielles',
                    'Santé' => 'santé',
                    'Alimentaire' => 'alimentaire',
                    'Entretien' => 'entretien'
                ],
            'expanded' => true
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Product::class,
        ]);
    }
}
