<?php
/**
 * Created by PhpStorm.
 * User: heshamelarj
 * Date: 4/6/19
 * Time: 3:24 PM
 */

namespace App\Admin;


use App\Entity\Service;
use App\Entity\Stock;
use App\Entity\User;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\QueryBuilder;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Form\Type\ModelType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class TacheAdmin extends AbstractAdmin
{
    private $urepo;
    public function __construct(string $code, string $class, string $baseControllerName, UserRepository $userRepo)
    {
        parent::__construct($code, $class, $baseControllerName);
        $this->urepo = $userRepo;
    }
    protected function configureFormFields(FormMapper $form)
    {


        $form       ->      add('nomtache',TextType::class)
                    ->      add('datedebut', DateType::class)
                    ->      add('datefin', DateType::class)
                    ->      add('employ', ModelType::class,
                                [
                                    'class'        =>        User::class,
                                    'property'     =>        'nom',
                                    'query'         =>        $this->urepo->findAllByExepctRoleValue('admin', 'chef') //TODO: best practice  this logic

                                ])
                    ->      add('service', ModelType::class,
                                [
                                    'class'         =>        Service::class,
                                    'property'      =>        'nomservice'
                                ]);
    }

    protected function configureDatagridFilters(DatagridMapper $filter)
    {
        $filter     ->      add('nomtache');

    }
    protected function configureListFields(ListMapper $list)
    {
        $list       ->      addIdentifier('nomtache')
                    ->      add('datedebut')
                    ->      add('datefin')
                    ->      add('employ')
                    ->      add('service');
    }

}