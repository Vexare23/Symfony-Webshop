<?php

declare(strict_types=1);

namespace App\Form;

use App\Entity\Category1;
use App\Entity\Product;
use App\Entity\Tag;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProductFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name')
            ->add('price')
            ->add('updatedAt', null, [
                'widget' => 'single_text'
            ])
            ->add('category', EntityType::class, [
                'class' => Category1::class,
            ])
            ->add('tags', EntityType::class, [
                'expanded' => true,
                'multiple' => true,
                'class' => Tag::class,
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Product::class,
        ]);
    }
}
