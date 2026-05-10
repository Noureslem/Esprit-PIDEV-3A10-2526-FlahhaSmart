<?php

declare(strict_types=1);

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Image;
use Symfony\Component\Validator\Constraints\NotNull;

final class PlantNetAnalysisType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('image', FileType::class, [
                'label' => false,
                'mapped' => false,
                'required' => true,
                'constraints' => [
                    new NotNull(message: 'Veuillez choisir une image de plante.'),
                    new Image(
                        maxSize: '8M',
                        maxSizeMessage: 'Image trop lourde (8 Mo max).',
                        mimeTypes: ['image/jpeg', 'image/png', 'image/webp'],
                        mimeTypesMessage: 'Formats autorises: JPEG, PNG, WEBP.',
                    ),
                ],
                'attr' => [
                    'accept' => 'image/jpeg,image/png,image/webp',
                ],
            ])
            ->add('organ', ChoiceType::class, [
                'label' => 'Zone observee',
                'choices' => [
                    'Feuille' => 'leaf',
                    'Fleur' => 'flower',
                    'Fruit' => 'fruit',
                    'Ecorce' => 'bark',
                    'Port general' => 'habit',
                    'Auto' => 'auto',
                    'Autre' => 'other',
                ],
                'data' => 'leaf',
                'required' => true,
            ])
            ->add('language', ChoiceType::class, [
                'label' => 'Langue resultat',
                'choices' => [
                    'Francais' => 'fr',
                    'English' => 'en',
                    'Arabic' => 'ar',
                ],
                'data' => 'fr',
                'required' => true,
            ])
            ->add('detectDiseases', CheckboxType::class, [
                'label' => 'Inclure le diagnostic maladies',
                'required' => false,
                'data' => true,
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'csrf_protection' => true,
            'translation_domain' => 'messages',
        ]);
    }
}
