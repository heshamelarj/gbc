<?php
/**
 * Created by PhpStorm.
 * User: heshamelarj
 * Date: 4/3/19
 * Time: 12:01 PM
 */

namespace App\Admin;


use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Form\Type\ModelType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use App\Entity\Projet;
use App\Entity\Facture;

class ClientAdmin extends AbstractAdmin
{


    protected function configureFormFields(FormMapper $form)
    {
        $form->add('nom',TextType::class);
        $form->add('prenom',TextType::class);
        $form->add('email',EmailType::class);
        $form->add('adresse',TextType::class);
        $form->add('datenaissance',DateTimeType::class);
        $form->add('cin',TextType::class);
        $form->add('telephone',TextType::class);
        $form->add('projets',ModelType::class, [
            'class' => Projet::class,
            'multiple' => true,
            'property' => 'nomprojet'
        ]);
       $form->add('factures', ModelType::class, array(
            'class' => Facture::class,
            'multiple' => true,
            'property' => 'numero'
        ));

    }
    protected function configureDatagridFilters(DatagridMapper $filter)
    {
        $filter->add('cin');
    }
    protected function configureListFields(ListMapper $list)
    {
        $list->add('nom')
        ->add('prenom')
        ->add('email')
        ->add('adresse')
        ->add('datenaissance')
        ->add('cin')
        ->add('telephone')
     /*   $list->add('projets',null, [
            'associated_property' => 'nomprojet'
        ]);*/
        ->add('factures',null, [
            'associated_property' => 'numero'
        ]);
    }


}