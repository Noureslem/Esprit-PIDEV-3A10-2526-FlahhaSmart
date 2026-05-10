<?php
// src/Form/RegistrationFormType.php
namespace App\Form;

use App\Entity\Users;  // Changé de User à Users
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints as Assert;

class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom', TextType::class, [
                'label' => 'form.registration.nom.label',
                'attr'  => ['placeholder' => 'form.registration.nom.placeholder'],
                'constraints' => [new Assert\NotBlank(), new Assert\Length(['min' => 2, 'max' => 100])],
            ])
            ->add('prenom', TextType::class, [
                'label'    => 'form.registration.prenom.label',
                'required' => false,
                'attr'     => ['placeholder' => 'form.registration.prenom.placeholder'],
            ])
            ->add('email', EmailType::class, [
                'label' => 'form.registration.email.label',
                'attr'  => ['placeholder' => 'form.registration.email.placeholder'],
                'constraints' => [new Assert\NotBlank(), new Assert\Email()],
            ])
            ->add('telephone', TextType::class, [
                'label'    => 'form.registration.telephone.label',
                'required' => false,
                'attr'     => ['placeholder' => 'form.registration.telephone.placeholder'],
            ])
            ->add('ville', TextType::class, [
                'label'    => 'form.registration.ville.label',
                'required' => false,
                'attr'     => ['placeholder' => 'form.registration.ville.placeholder'],
            ])
            ->add('role', ChoiceType::class, [
                'label'   => 'form.registration.role.label',
                'choices' => [
                    'form.registration.role.choice.agriculteur' => 'AGRICULTEUR',
                    'form.registration.role.choice.client' => 'CLIENT',
                ],
                'choice_translation_domain' => 'messages',
            ])
            ->add('plainPassword', RepeatedType::class, [
                'type'            => PasswordType::class,
                'mapped'          => false,
                'first_options'   => ['label' => 'form.registration.password.label', 'attr' => ['placeholder' => 'form.registration.password.placeholder']],
                'second_options'  => ['label' => 'form.registration.password.confirm_label', 'attr' => ['placeholder' => 'form.registration.password.confirm_placeholder']],
                'constraints'     => [
                    new Assert\NotBlank(),
                    new Assert\Length(['min' => 6]),
                ],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Users::class,  // Changé de User::class à Users::class
            'translation_domain' => 'messages',
        ]);
    }
}