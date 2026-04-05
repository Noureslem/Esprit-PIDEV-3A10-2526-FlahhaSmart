<?php
namespace App\Form\article;

use App\Entity\article\Order;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Positive;

class OrderType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('reference', TextType::class, [
                'label' => 'Référence',
                'constraints' => [
                    new NotBlank(),
                    new Length(['min' => 3, 'max' => 50]),
                ],
            ])
            ->add('dateCommande', DateType::class, [
                'label' => 'Date de commande',
                'widget' => 'single_text',
                'constraints' => [new NotBlank()],
            ])
            ->add('statut', TextType::class, [
                'label' => 'Statut',
                'constraints' => [
                    new NotBlank(),
                    new Length(['min' => 3, 'max' => 50]),
                ],
            ])
            ->add('modePaiement', TextType::class, [
                'label' => 'Mode de paiement',
                'constraints' => [
                    new NotBlank(),
                    new Length(['min' => 3, 'max' => 50]),
                ],
            ])
            ->add('adresseLivraison', TextType::class, [
                'label' => 'Adresse de livraison',
                'constraints' => [
                    new NotBlank(),
                    new Length(['min' => 2, 'max' => 255]),
                ],
            ])
            ->add('montantTotal', NumberType::class, [
                'label' => 'Montant total (€)',
                'constraints' => [
                    new NotBlank(),
                    new Positive(),
                ],
            ])
            ->add('fraisLivraison', NumberType::class, [
                'label' => 'Frais de livraison (€)',
                'constraints' => [
                    new NotBlank(),
                    new Positive(),
                ],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Order::class,
        ]);
    }
}