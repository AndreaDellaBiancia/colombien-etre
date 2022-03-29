<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;

class PostType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title', null, [
                'label' => 'Titre*',
                'constraints' => [new NotBlank()]
            ])
            ->add('content', TextareaType::class, [
                'attr' => ['class' => 'ckeditor']
                ])
            ->add('thumbnailPicture', null, [
                'label' => 'Photo diapo*',
                'constraints' => [new NotBlank()]
            ])
            ->add('mainPicture', null, [
                'label' => 'Photo principale*',
                'constraints' => [new NotBlank()]
            ])
            ->add('author')
            ->add('source')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
        ]);
    }
}
