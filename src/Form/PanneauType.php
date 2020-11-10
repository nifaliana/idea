<?php

namespace App\Form;

use App\Entity\Panneau;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PanneauType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('format')
            ->add('unit')
            ->add('lat')
            ->add('lng')
            ->add('tarifImpression')
            ->add('rating')
            ->add('confection')
            ->add('typologie')
            ->add('contrat')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Panneau::class,
            'method' => 'post'
        ]);
    }
}
