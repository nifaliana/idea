<?php

namespace App\Form;

use App\Entity\Contrat;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Vich\UploaderBundle\Form\Type\VichFileType;

class ContratType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('imageFile', VichFileType::class, [
                'label' => "Bordereau du contrat",
                'required' => false
            ])
            ->add('signedAt', DateType::class, [
                'widget' => 'single_text',
                'label' => "Date de signature"
            ])
            ->add('endedAt', DateType::class, [
                'widget' => 'single_text',
                'label' => "Date fin du contrat"
            ])
            ->add('amount', null, [
                'label' => "Somme à payer"
            ])
            ->add('client')
            ->add('payement', CollectionType::class, [
                'entry_type' => PayementType::class,
                'allow_add' => true
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Contrat::class
        ]);
    }
}
