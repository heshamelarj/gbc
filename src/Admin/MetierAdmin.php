<?php
/**
 * Created by PhpStorm.
 * User: heshamelarj
 * Date: 4/6/19
 * Time: 3:06 PM
 */

namespace App\Admin;


use App\Entity\User;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Form\Type\ModelType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class MetierAdmin extends AbstractAdmin
{
    protected function configureFormFields(FormMapper $form)
    {
        $form       ->      add('nommetier', TextType::class)
                    ->      add('users', ModelType::class,
                                [
                                    'class'     =>      User::class,
                                    'multiple'  =>      true,
                                    'property'  =>      'nom'
                                ]);
    }
    protected function configureDatagridFilters(DatagridMapper $filter)
    {
        $filter    ->       add('nommetier');
    }
    protected function configureListFields(ListMapper $list)
    {
        $list       ->      addIdentifier('nommetier')
                    ->      add('users');
    }

}