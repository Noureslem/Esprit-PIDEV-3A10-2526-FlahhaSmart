<?php

namespace App\Form;

use App\Entity\Equipement;
use App\Entity\Operation;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use App\Repository\EquipementRepository;
use Symfony\Component\Form\Extension\Core\Type\DateType;

class OperationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('type_operation', null, [
                'required' => true,
                'label' => 'operation.form.type_operation.label',
                'attr' => [
                    'placeholder' => 'operation.form.type_operation.placeholder',
                ],
            ])
            ->add('date_debut', DateType::class, [
                'widget' => 'single_text',
                'html5' => true,
                'required' => true,
                'label' => 'operation.form.date_debut.label',
                'attr' => [
                    'class' => 'form-control js-flatpickr',
                    'autocomplete' => 'off'
                ],
            ])
            ->add('date_fin', DateType::class, [
                'widget' => 'single_text',
                'html5' => true,
                'required' => true,
                'label' => 'operation.form.date_fin.label',
                'attr' => [
                    'class' => 'form-control js-flatpickr',
                    'autocomplete' => 'off'
                ],
            ])
            ->add('equipement', EntityType::class, [
            'class' => Equipement::class,
            'choice_label' => 'nom',
            'label' => 'operation.form.equipement.label',
            'query_builder' => function (EquipementRepository $er) use ($options) {

                $qb = $er->createQueryBuilder('e')
                    ->where('e.etat = :etat')
                    ->setParameter('etat', 'libre');

                if ($options['data'] && $options['data']->getEquipement()) {
                    $qb->orWhere('e = :equipement')
                    ->setParameter('equipement', $options['data']->getEquipement());
                }

                return $qb->orderBy('e.nom', 'ASC');
            },
        ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Operation::class,
            'translation_domain' => 'messages',
        ]);
    }
}
