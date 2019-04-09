<?php
/**
 * Created by PhpStorm.
 * User: heshamelarj
 * Date: 4/4/19
 * Time: 7:56 PM
 */

namespace App\Admin;


use App\Entity\Fournisseur;
use App\Entity\LigneFacture;
use App\Entity\Client;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Form\Type\ModelType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

final class FactureAdmin extends AbstractAdmin
{
    protected function configureFormFields(FormMapper $form)
    {
        $form->add('numero' , IntegerType::class)
             ->add('desingation',TextType::class)
             ->add('fournisseur', ModelType::class,[
                 'class'    => Fournisseur::class,
                 'property' => 'nom'
             ])
             ->add('client', ModelType::class, [
                 'class'    => Client::class,
                 'property' => 'nom'
             ])
             ->add('lignefactures', ModelType::class, [
                 'class'    => LigneFacture::class,
                 'multiple' => true,
                 'property' => 'id'
             ]);
    }

    protected function configureDatagridFilters(DatagridMapper $filter)
    {
        $filter->add('numero');
    }
    protected function configureListFields(ListMapper $list)
    {
        $list->addIdentifier('numero')
             ->add('desingation')
             ->add('fournisseur')
             ->add('client')
             ->add('lignefactures');
    }

}