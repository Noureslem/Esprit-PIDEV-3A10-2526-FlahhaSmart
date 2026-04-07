<?php

namespace App\Form;

use App\Entity\Equipement;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class EquipementType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom', null, [
                'required' => true,
                'label' => 'equipement.form.nom.label',
                'attr' => [
                    'placeholder' => 'equipement.form.nom.placeholder',
                ],
            ])
            ->add('type', ChoiceType::class, [
            'label' => 'equipement.form.type.label',
            'choices' => [
            'equipement.type.machine' => 'Machine',
            'equipement.type.irrigation' => 'Irrigation',
            'equipement.type.elevage' => 'Élevage',
            'equipement.type.outil_manuel' => 'Outil manuel',
            'equipement.type.transport' => 'Transport', ],
            'choice_translation_domain' => 'messages',
            'placeholder' => 'equipement.form.type.placeholder',
             ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Equipement::class,
            'translation_domain' => 'messages',
        ]);
    }
}
