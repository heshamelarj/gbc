<?php

namespace App\Form;

use App\Entity\Client;
use Sonata\Form\Type\CollectionType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ClientType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom')
            ->add('prenom')
            ->add('email')
            ->add('datenaissance')
            ->add('cin')
            ->add('telephone')
            ->add('adresse')
            ->add('projets', CollectionType::class, [
                 'entry_type' => ProjetType::class,
                 'entry_options' => ['label' => false],
             ]);

        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Client::class,
        ]);
    }
}
