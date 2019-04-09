<?php
/*/**
 * Created by PhpStorm.
 * User: heshamelarj
 * Date: 4/5/19
 * Time: 10:15 AM
 */

namespace App\Admin;


use App\Entity\Tache;
use App\Entity\User;
use App\Repository\UserRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\QueryBuilder;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Form\Type\ModelAutocompleteType;
use Sonata\AdminBundle\Form\Type\ModelType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class ServiceAdmin extends AbstractAdmin
{
    public $repo;
    public function __construct(string $code, string $class, string $baseControllerName, UserRepository $repo)
    {
        parent::__construct($code, $class, $baseControllerName);
        $this->repo = $repo;

    }

    protected function configureFormFields(FormMapper $form)
    {
        $queryBuilderObject = $this->repo->findByRoleField('designer');
        $form   ->      add('nomservice', TextType::class)
                ->      add('datedebut',DateTimeType::class)
                ->      add('datefin', DateTimeType::class)
                ->      add('employes', ModelType::class,
                            [
                                'class'     =>      User::class,
                                'query'     =>      $queryBuilderObject,
                                'multiple'  =>      true,
                                'property'  =>      'nom'
                            ]
                        );
               /* ->      add('taches', ModelType::class,
                            [
                                'class'     =>      Tache::class,
                            ]
                    );*/

    }

    protected function configureDatagridFilters(DatagridMapper $filter)
    {
        $filter->add('nomservice');
    }

    protected function configureListFields(ListMapper $list)
    {
        $list   ->      add('nomservice')
                ->      add('datedebut')
                ->      add('datefin')
                ->      add('employes');
    }

}