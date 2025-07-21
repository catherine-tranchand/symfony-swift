<?php

namespace App\Form;

use App\Entity\Address;
use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CountryType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AddressUserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('firstname', TextType::class, [
                'label' => 'Votre prénom',
                'attr' => [
                    'placeholder' => 'Indiquer votre prénom'
                ]
            ]   )
            ->add('lastname', TextType::class, [
                'label' => 'Votre nom',
                 'attr' => [
                    'placeholder' => 'Indiquer votre nom '
                 ]

            ])
            ->add('address', TextType::class, [
                'label' => 'Votre adresse',
                 'attr' => [
                    'placeholder' => 'Indiquer votre adresse '
                 ]

            ])
            ->add('postalcode', TextType::class, [
                'label' => 'Votre code postale',
                 'attr' => [
                    'placeholder' => 'Indiquer votre code postale '
                 ]

            ])
            ->add('city', TextType::class, [
                'label' => 'Votre ville',
                 'attr' => [
                    'placeholder' => 'Indiquer votre ville'
                 ]

            ])
            ->add('country', CountryType::class, [
                'label' => 'Votre pays',
                 'attr' => [
                    'placeholder' => 'Indiquer votre pays de livraison '
                 ]

            ])
            ->add('phonenumber', TextType::class, [
                'label' => 'Votre numéro portable',
                 'attr' => [
                    'placeholder' => 'Indiquer votre numero portable '
                 ]

            ])

               ->add('submit', SubmitType::class, [
                'label' => 'Sauvegarder',
                'attr' => [
                    'class' => 'btn btn-success',
                ],
            ])
          
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Address::class,
        ]);
    }
}
