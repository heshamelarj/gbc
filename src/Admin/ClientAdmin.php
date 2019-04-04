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
use Sonata\AdminBundle\Form\Type\ModelAutocompleteType;
use Sonata\AdminBundle\Form\Type\ModelListType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use App\Entity\Projet;
use App\Entity\Facture;
use App\Form\ProjetType;

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
        $form->add('projets',CollectionType::class, [
           'entry_type' => ProjetType::class
       ]);
       /* $form->add('factures', ModelAutocompleteType::class, array(
            'multiple' => true
        ));*/

    }
    protected function configureDatagridFilters(DatagridMapper $filter)
    {
        $filter->add('cin');
    }
    protected function configureListFields(ListMapper $list)
    {
        $list->add('nom');
        $list->add('prenom');
        $list->add('email');
        $list->add('adresse');
        $list->add('datenaissance');
        $list->add('cin');
        $list->add('telephone');
        $list->add('projets');
    }


}