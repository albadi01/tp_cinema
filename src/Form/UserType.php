<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('prenom', TextType::class, [
                    'label' => false ,
                    'attr' => [
                        'placeholder' =>'prenom'
                    ]
            ])
            ->add('nom',TextType::class, [
                'label' => false ,
                'attr' => [
                    'placeholder' =>'nom'
                ]
            ]) 
            ->add('pseudo', TextType::class, [
                'label' => false,
                'required' => false,
                'attr' => [
                    'pattern' => false,
                    'placeholder' => 'pseudo'
                ]
            ])
            ->add('email', EmailType::class,[
                'label' => false,
                'attr' => [
                    'placeholder' => 'Votre email'
                ]
            ])
           
            // ->add('roles')
            ->add('password', PasswordType::class,[
                'label' => false,
                'attr' => [
                    'placeholder' => 'mot de passe'
                ]
            ])
           
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
