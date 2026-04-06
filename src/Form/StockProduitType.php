<?php

namespace App\Form;

use App\Entity\StockProduit;
use App\Entity\Users;
use App\Repository\UsersRepository;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class StockProduitType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('typeProduit', TextType::class, [
                'label' => 'Type de Produit',
                'attr' => ['class' => 'form-control', 'placeholder' => 'Ex: Engrais, Semences...']
            ])
            ->add('variete', TextType::class, [
                'label' => 'Variété',
                'attr' => ['class' => 'form-control', 'placeholder' => 'Ex: Tomate Marmande']
            ])
            ->add('dateDebut', DateType::class, [
                'widget' => 'single_text',
                'label' => 'Date de Début',
                'attr' => ['class' => 'form-control']
            ])
            ->add('dateFinEstimee', DateType::class, [
                'widget' => 'single_text',
                'label' => 'Date de Fin Estimée',
                'required' => false,
                'attr' => ['class' => 'form-control']
            ])
            ->add('statut', ChoiceType::class, [
                'label' => 'Statut',
                'choices' => [
                    'En cours' => 'en cours',
                    'Terminé' => 'terminé',
                    'En croissance' => 'en croissance',
                ],
                'attr' => ['class' => 'form-select']
            ]);
            //->add('user', EntityType::class);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => StockProduit::class,
        ]);
    }
}
