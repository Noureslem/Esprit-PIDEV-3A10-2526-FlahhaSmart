<?php

namespace App\Form;

use App\Entity\Users;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints as Assert;

class AdminUserFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $isNew = $options['is_new'];

        $builder
            ->add('nom', TextType::class, [
                'label' => 'form.admin_user.nom.label',
                'attr'  => ['class' => 'form-control'],
                'constraints' => [new Assert\NotBlank()],
            ])
            ->add('prenom', TextType::class, [
                'label'    => 'form.admin_user.prenom.label',
                'required' => false,
                'attr'     => ['class' => 'form-control'],
            ])
            ->add('email', EmailType::class, [
                'label' => 'form.admin_user.email.label',
                'attr'  => ['class' => 'form-control'],
                'constraints' => [new Assert\NotBlank(), new Assert\Email()],
            ])
            ->add('telephone', TextType::class, [
                'label'    => 'form.admin_user.telephone.label',
                'required' => false,
                'attr'     => ['class' => 'form-control'],
            ])
            ->add('ville', TextType::class, [
                'label'    => 'form.admin_user.ville.label',
                'required' => false,
                'attr'     => ['class' => 'form-control'],
            ])
            ->add('role', ChoiceType::class, [
                'label'   => 'form.admin_user.role.label',
                'attr'    => ['class' => 'form-select'],
                'choices' => [
                    'form.admin_user.role.choice.admin' => 'ADMINISTRATEUR',
                    'form.admin_user.role.choice.agriculteur' => 'AGRICULTEUR',
                    'form.admin_user.role.choice.client' => 'CLIENT',
                ],
                'choice_translation_domain' => 'messages',
            ])
            ->add('actif', CheckboxType::class, [
                'label'    => 'form.admin_user.actif.label',
                'required' => false,
                'attr'     => ['class' => 'form-check-input'],
            ])
            ->add('plainPassword', PasswordType::class, [
                'label'    => $isNew ? 'form.admin_user.password.new_label' : 'form.admin_user.password.edit_label',
                'mapped'   => false,
                'required' => $isNew,
                'attr'     => ['class' => 'form-control', 'placeholder' => $isNew ? 'form.admin_user.password.new_placeholder' : 'form.admin_user.password.edit_placeholder'],
                'constraints' => $isNew ? [
                    new Assert\NotBlank(),
                    new Assert\Length(['min' => 6]),
                ] : [
                    new Assert\Length(['min' => 6]),
                ],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Users::class,
            'is_new'     => true,
            'translation_domain' => 'messages',
        ]);
    }
}
