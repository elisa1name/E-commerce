<?php

namespace App\Form;

use App\Entity\Variants;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class VariantsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('price')
            ->add('color')
            ->add('mark')
            ->add('stock')
            ->add('Memory_size')
            ->add('Screen_size')
            ->add('capacity')
            ->add('Weight_of_article')
            ->add('Operating_system')
            ->add('article')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Variants::class,
        ]);
    }
}
