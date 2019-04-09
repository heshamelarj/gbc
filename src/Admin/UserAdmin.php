<?php
/**
 * Created by PhpStorm.
 * User: heshamelarj
 * Date: 4/5/19
 * Time: 6:23 PM
 */

namespace App\Admin;


use App\Entity\Metier;
use App\Entity\Service;
use App\Entity\Tache;
use App\Services\UserSecurity;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\Type\ModelType;
use Sonata\BlockBundle\Form\Mapper\FormMapper;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Security\Core\User\UserInterface;

class UserAdmin extends AbstractAdmin
{
    private $passwordEncoderService;


     public function __construct(string $code, string $class, string $baseControllerName, UserSecurity $encodePassword)
       {
           parent::__construct($code, $class, $baseControllerName);
           $this->passwordEncoderService = $encodePassword;
       }

    protected function configureFormFields(\Sonata\AdminBundle\Form\FormMapper $form)
    {

        $form->add('login', TextType::class)
            ->add('nom', TextType::class)
            ->add('prenom', TextType::class)
            ->add('photo', FileType::class)
            ->add('datenaissance', DateType::class)
            ->add('role', TextType::class)
            ->add('cin', TextType::class)
            ->add('telephone', TextType::class)
            ->add('metiers', ModelType::class,
                [
                    'class' => Metier::class,
                    'multiple' => true,
                    'property' => 'nommetier'
                ])
            ->add('services', ModelType::class,
                [
                    'class' => Service::class,
                    'multiple' => true,
                    'property' => 'nomservice'
                ])
            ->add('taches', ModelType::class,
                [
                    'class' => Tache::class,
                    'multiple' => true,
                    'property' => 'nomtache'
                ]);


    }
    public function prePersist($object)
    {
        $object->setPassword($this->passwordEncoderService->encodeUserPassword($object, $object->getDatenaissance()->format('Y-m-d h:i:s')));
    }

    protected function configureDatagridFilters(DatagridMapper $filter)
    {
        $filter->add('nom');
    }

    protected function configureListFields(ListMapper $list)
    {
        $list->addIdentifier('nom')
            ->add('role')
            ->add('photo')
            ->add('metiers')
            ->add('services')
            ->add('taches');
    }
}