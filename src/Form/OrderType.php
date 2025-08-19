<?php

namespace App\Form;

use App\Entity\Address;
use App\Entity\Carrier;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class OrderType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('addresses', EntityType::class, [
                'label' => 'Choisissez votre adresse de livraison',
                'required' => true,
                'class' => Address::class, //pour se lier avec address entity et avoir acces aux base de donnees
                'expanded' => true,
                'choices' => $options['addresses'],
                'multiple' => false,
                'label_html' => true,

            ])
            ->add('carriers', EntityType::class, [
                'label' => 'Choisissez votre trasporteur de livraison',
                'required' => true,
                'class' => Carrier::class, //pour se lier avec address entity et avoir acces aux base de donnees
                'expanded' => true,
                'multiple' => false,
                'label_html' => true,
                
            ])
            ->add('submit', SubmitType::class, options:[
                'label' => 'Valider',
                
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
      $resolver->setRequired('addresses');
    }
}
