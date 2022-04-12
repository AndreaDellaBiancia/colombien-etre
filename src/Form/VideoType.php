<?php

namespace App\Form;

use App\Entity\VideoSpirituality;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;

class VideoType extends AbstractType
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
        ->add('videoLink', null, [
            'label' => 'Link Video*',
            'constraints' => [new NotBlank()]
        ])
        ->add('authorLink', null, [
            'label' => 'Link page author *',
            'constraints' => [new NotBlank()]
        ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => VideoSpirituality::class,
        ]);
    }
}
