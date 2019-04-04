<?php
/**
 * Created by PhpStorm.
 * User: heshamelarj
 * Date: 4/2/19
 * Time: 9:04 PM
 */

namespace App\Admin;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Sonata\AdminBundle\Form\Type\ModelType;
use App\Entity\Client;

class ProjetAdmin extends AbstractAdmin
{
    protected function configureFormFields(FormMapper $form)
    {

        $form->add('nomprojet',TextType::class);
        $form->add('datefin',DateTimeType::class);
        $form->add('datedebut',DateTimeType::class);
        $form->add('budget',MoneyType::class,
            [
                'currency' => 'MAD'
            ]);
        $form->add('avance',MoneyType::class,

            [
                'currency' => 'MAD'
            ]);
        $form->add(
                    'client', ModelType::class,
                        [
                        'class' => Client::class,
                        'property'=> 'nom'
                    ]);
    }
    protected function configureDatagridFilters(DatagridMapper $filter)
    {
        $filter->add('nomprojet');
    }
    protected function configureListFields(ListMapper $list)
    {

        $list->add('nomprojet');
        $list->add('datefin');
        $list->add('datedebut');
        $list->add('budget');
        $list->add('avance');
        $list->add('client');
    }
}
