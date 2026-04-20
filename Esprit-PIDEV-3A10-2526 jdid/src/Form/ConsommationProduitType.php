<?php

namespace App\Form;

use App\Entity\ConsommationProduit;
use App\Entity\StockProduit;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ConsommationProduitType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('surface', NumberType::class, [
                'label' => 'Surface',
                'attr' => ['class' => 'form-control', 'placeholder' => 'Ex: 2.5 (en hectares ou m2)']
            ])
            ->add('quantiteUtilisee', NumberType::class, [
                'label' => 'Quantité Utilisée',
                'attr' => ['class' => 'form-control', 'placeholder' => 'Ex: 150']
            ])
            ->add('unite', TextType::class, [
                'label' => 'Unité',
                'attr' => ['class' => 'form-control', 'placeholder' => 'Ex: Kg, Litre, etc.']
            ])
            ->add('dateRecolte', DateType::class, [
                'widget' => 'single_text',
                'label' => 'Date de Récolte',
                'attr' => ['class' => 'form-control']
            ])
            ->add('dateUtilisation', DateType::class, [
                'widget' => 'single_text',
                'label' => 'Date d\'Utilisation',
                'attr' => ['class' => 'form-control']
            ])
            ->add('stockProduit', EntityType::class, [
                'class' => StockProduit::class,
                'choice_label' => function (StockProduit $stock) {
                    return $stock->getTypeProduit() . ' - ' . $stock->getVariete();
                },
                'label' => 'Produit de Stock associé',
                'attr' => ['class' => 'form-select']
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => ConsommationProduit::class,
        ]);
    }
}
