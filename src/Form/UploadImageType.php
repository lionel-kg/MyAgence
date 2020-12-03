<?php

namespace App\Form;

use App\Entity\Property;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class UploadImageType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title' , TextType::class)
            ->add('description' , TextType::class)
            ->add('surface' , TextType::class)
            ->add('rooms' , TextType::class)
            ->add('bedrooms' , TextType::class)
            ->add('floor' , TextType::class)
            ->add('price' , TextType::class)
            ->add('heat' , TextType::class)
            ->add('city' , TextType::class)
            ->add('address' , TextType::class)
            ->add('postal_code' , TextType::class)
            ->add('image' , FileType::class)
            ->add('save' , SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Property::class,
        ]);
    }
}
