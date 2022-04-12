<?php

namespace App\Form;

use App\Entity\ReadingSpirituality;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;

class ReadingType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('title', null, [
            'label' => 'Titre*',
            'constraints' => [new NotBlank()]
        ])
        ->add('description', TextareaType::class, [
            'attr' => ['class' => 'ckeditor']
            ])
        ->add('link', null, [
            'label' => 'Lien achat livre*',
            'constraints' => [new NotBlank()]
        ])
        ->add('author', null, [
            'label' => 'Author *',
            'constraints' => [new NotBlank()]
        ])
        ->add('picture', null, [
            'label' => 'Lien de l\'image *',
            'constraints' => [new NotBlank()]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => ReadingSpirituality::class,
        ]);
    }
}
