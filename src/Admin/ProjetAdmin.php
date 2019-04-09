<?php
/**
 * Created by PhpStorm.
 * User: heshamelarj
 * Date: 4/2/19
 * Time: 9:04 PM
 */

namespace App\Admin;
use App\Entity\Service;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Form\Type\ModelAutocompleteType;
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

        $form->add('nomprojet',TextType::class)
                ->      add('datefin',DateTimeType::class)
                ->      add('datedebut',DateTimeType::class)
                ->      add('budget',MoneyType::class,
                                [
                                    'currency'   =>    'MAD'
                                ]
                            )
                ->      add('avance',MoneyType::class,
                                [
                                    'currency'  =>      'MAD'
                                ]
                            )
                ->      add('client', ModelAutocompleteType::class,
                                [
                                    'class'     =>      Client::class,
                                    'property'  =>      'nom',
                                    'btn_add'   =>      'Ajouter Client'
                                ]
                            )
                ->      add('services', ModelAutocompleteType::class,
                                [
                                    'class'         =>      Service::class,
                                    'multiple'      =>      true,
                                    'placeholder'   =>      'rechercher/selctioner une service',
                                    'property'      =>      'nomservice',
                                    'btn_add'       =>      'Ajouter Service'
                                ]
                            );
    }
    protected function configureDatagridFilters(DatagridMapper $filter)
    {
        $filter->add('nomprojet');
    }
    protected function configureListFields(ListMapper $list)
    {

        $list   ->     addIdentifier('nomprojet')
                ->     add('datefin')
                ->     add('datedebut')
                ->     add('budget')
                ->     add('avance')
                ->     add('client')
                ->     add('services');

    }
}
