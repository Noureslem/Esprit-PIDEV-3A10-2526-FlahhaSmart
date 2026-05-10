<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class OperationPdfExportType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $choices = [];
        foreach ($options['available_columns'] as $column => $labelKey) {
            $choices[$labelKey] = $column;
        }

        $builder->add('columns', ChoiceType::class, [
            'label' => false,
            'choices' => $choices,
            'multiple' => true,
            'expanded' => true,
            'required' => false,
            'data' => $options['default_columns'],
            'choice_translation_domain' => 'messages',
        ]);

        foreach (['type', 'statut', 'sort', 'direction'] as $field) {
            $builder->add($field, HiddenType::class, [
                'required' => false,
            ]);
        }
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'available_columns' => [],
            'default_columns' => [],
            'csrf_protection' => true,
        ]);

        $resolver->setAllowedTypes('available_columns', 'array');
        $resolver->setAllowedTypes('default_columns', 'array');
    }
}
