<?php

namespace App\Form;

use App\Entity\AnonymousUser;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AnonymousUserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('lastname', TextType::class, [
                'label' => 'Nom',
                'attr' => [
                    'placeholder' => 'Entrez votre nom',
                ]
            ])
            ->add('firstname', TextType::class, [
                'label' => 'Prénom',
                'attr' => [
                    'placeholder' => 'Entrez votre prénom',
                ]
            ])
            ->add('email', EmailType::class, [
                'label' => 'Email',
                'attr' => [
                    'placeholder' => 'Entrez votre adresse email',
                ]
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'Je télécharge la liste des 300 valeurs',
                'attr' => [
                    'class' => 'btn btn-light zen-button btn-lg text-light mt-4 w-100',
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => AnonymousUser::class,
        ]);
    }
}
