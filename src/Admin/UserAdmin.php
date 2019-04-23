<?php
/**
 * Created by PhpStorm.
 * User: heshamelarj
 * Date: 4/5/19
 * Time: 6:23 PM
 */

namespace App\Admin;


use App\Entity\Image;
use App\Entity\Metier;
use App\Entity\Role;
use App\Entity\Service;
use App\Entity\Tache;
use App\Service\UserSecurity;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\Type\AdminType;
use Sonata\AdminBundle\Form\Type\ModelType;
use Sonata\AdminBundle\Form\FormMapper;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class UserAdmin extends AbstractAdmin
{
    private $passwordEncoder;
    public function __construct(string $code, string $class, string $baseControllerName,UserSecurity $passwordEncoding)
       {
           parent::__construct($code, $class, $baseControllerName);
           $this->passwordEncoder = $passwordEncoding;
       }



    protected function configureFormFields(FormMapper $form)
    {



        $form->add('login', TextType::class)
            ->add('nom', TextType::class)
            ->add('prenom', TextType::class)
            ->add('image', AdminType::class,
                [
                    'label'     =>      'Photo'
                ])
            ->add('datenaissance', DateType::class)
            ->add('employeRoles', ModelType::class,
        [
            'class'     =>      Role::class,
            'multiple'  =>      true,
            'property'  =>      'name',
            'btn_add'   =>      'Ajouter'
        ])
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

    /**
     * @param $object
     */
    public function prePersist($object)
    {
        //TODO: Code Review Needed
        $this->manageEmbeddedImageAdmins($object);
        $hashedDefaultPassword = $this->passwordEncoder->encodeUserPassword($object, $object->getDatenaissance()->format('Y-m-d h:i:s'));
        $object->setPassword($hashedDefaultPassword);
    }

    /**
     * @param $object
     */
    public function preUpdate($object)
    {

        $this->manageEmbeddedImageAdmins($object);
        //TODO: Move the default password logic to the Getter/Setter
        $hashedDefaultPassword = $this->passwordEncoder->encodeUserPassword($object, $object->getDatenaissance()->format('Y-m-d h:i:s'));
        $object->setPassword($hashedDefaultPassword);
    }

    protected function configureDatagridFilters(DatagridMapper $filter)
    {
        $filter->add('nom');
    }

    protected function configureListFields(ListMapper $list)
    {
        $list->add('image', 'string',
                [
                    'template'      =>      'admin/image_preview.html.twig'
                ]
            )
            ->addIdentifier('login')
            ->add('nom')
            ->add('employeRoles')
            ->add('metiers')
            ->add('services')
            ->add('taches');
    }




    private function manageEmbeddedImageAdmins($page)
    {

        foreach ($this->getFormFieldDescriptions() as $fieldName => $fieldDescription) {
            // detect embedded Admins that manage Images


            if ($fieldDescription->getType() === AdminType::class &&
                ($associationMapping = $fieldDescription->getAssociationMapping()) &&
                $associationMapping['targetEntity'] === 'App\Entity\Image'
            ) {


                $getter = 'get' . $fieldName;
                $setter = 'set' . $fieldName;

                /** @var Image $image */
                $image = $page->$getter();

                if ($image) {
                    if ($image->getFile()) {

                        // update the Image to trigger file management

                        $image->refreshUpdated();
                    } else if (!$image->getFile() && !$image->getName()) {

                        // prevent Sf/Sonata trying to create and persist an empty Image
                        $page->$setter(null);
                    }
                }
            }
        }
    }

}