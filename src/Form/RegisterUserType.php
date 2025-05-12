<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;


class RegisterUserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email', EmailType::class, [
                'label' => 'Email',
                'attr' => [
                    'placeholder' => 'Enter your email',
                ],
                
            ])
                 ->add('plainPassword', RepeatedType::class, [
                'type' => PasswordType::class,
                'constraints' => [ 
                    new Length([
                        'min' => 4,
                        'max' => 30,
                    ])
                    ],
                'first_options'  => [
                    'label' => 'Votre mot de passe', 
                    'attr' => [
                        'placeholder' => 'Choisissez un mot de passe'
                    ],
                    'hash_property_path' => 'password'],
                'second_options' => [
                    'label' => 'Comfirmer votre mot de passe',
                    'attr' => [
                        'placeholder' => 'Votre mot de passe'
                    ]
                ],
                'mapped' => false,
            ])
            
            ->add('firstname', TextType::class, [
                'constraints' => [ 
                    new Length([
                        'min' => 2,
                        'max' => 30,
                    ])
                    ],
                'label' => 'First Name',
                'attr' => [
                    'placeholder' => 'Enter your first name',
                ],
                
    ])
            ->add('lastname', TextType::class, [
                'constraints' => [ 
                    new Length([
                        'min' => 4,
                        'max' => 30,
                    ])
                    ],
                'label' => 'Last Name',
                'attr' => [
                    'placeholder' => 'Enter your last name',
                ],
                
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'Register',
                'attr' => [
                    'class' => 'btn btn-success',
                ],
            ]) 
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'constraints' => [
                new UniqueEntity([
                    'entityClass' => User::class,
                    'fields' => 'email',
                    'message' => 'Ce mail est déjà utilisé',
                ]),
            ],
            'data_class' => User::class,
        ]);
    }
}
