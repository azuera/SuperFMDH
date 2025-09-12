<?php

namespace App\Form;

use App\Entity\Listing;
use App\Entity\ProperType;
use App\Entity\TransactionType;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ListingType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title', null, [
                'attr' => ['class' => 'form-control'],
                'label' => 'Titre'
            ])
            ->add('description', null, [
                'attr' => ['class' => 'form-control', 'rows' => 4],
                'label' => 'Description'
            ])
            ->add('price', null, [
                'attr' => ['class' => 'form-control'],
                'label' => 'Prix'
            ])
            ->add('city', null, [
                'attr' => ['class' => 'form-control'],
                'label' => 'Ville'
            ])
            ->add('image_url', null, [
                'attr' => ['class' => 'form-control'],
                'label' => 'URL de l\'image',
                'required' => false
            ])
            ->add('property_type_id', EntityType::class, [
                'class' => ProperType::class,
                'choice_label' => 'name',
                'attr' => ['class' => 'form-control'],
                'label' => 'Type de propriété',
                'placeholder' => 'Choisissez un type',
                'required' => true
            ])
            ->add('transaction_type_id', EntityType::class, [
                'class' => TransactionType::class,
                'choice_label' => 'name',
                'attr' => ['class' => 'form-control'],
                'label' => 'Type de transaction',
                'placeholder' => 'Choisissez un type',
                'required' => true
            ])
            
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Listing::class,
        ]);
    }
}