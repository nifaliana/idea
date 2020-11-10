<?php

namespace App\Form;

use App\Entity\Payement;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PayementType extends AbstractType
{
    const PAYEMENT = [
        "Chèque" => "Chèque",
        "Carte bancaire" => "Carte bancaire",
        "Espèce" => "Espèce",
        "Autre" => "Autre",
    ];

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('reference')
            ->add('somme')
            ->add('modePayement', ChoiceType::class, [
                'choices' => self::PAYEMENT
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Payement::class,
        ]);
    }
}
