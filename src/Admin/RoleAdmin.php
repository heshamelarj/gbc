<?php
/**
 * Created by PhpStorm.
 * User: heshamelarj
 * Date: 4/18/19
 * Time: 2:04 PM
 */

namespace App\Admin;


use App\Entity\User;
use Doctrine\DBAL\Types\TextType;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Form\Type\ModelType;

class RoleAdmin extends AbstractAdmin
{
    protected function configureFormFields(FormMapper $form)
    {
        $form->add('name', \Symfony\Component\Form\Extension\Core\Type\TextType::class);
    }

    protected function configureListFields(ListMapper $list)
    {
        $list->addIdentifier('name');
    }

}