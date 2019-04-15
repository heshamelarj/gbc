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
use App\Entity\Service;
use App\Entity\Tache;
use App\Services\UserSecurity;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\Type\AdminType;
use Sonata\AdminBundle\Form\Type\ModelType;
use Sonata\BlockBundle\Form\Mapper\FormMapper;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class UserAdmin extends AbstractAdmin
{
    private $passwordEncoder;
    public function __construct(string $code, string $class, string $baseControllerName,UserSecurity $passwordEncoding)
       {
           parent::__construct($code, $class, $baseControllerName);
           $this->passwordEncoder = $passwordEncoding;
       }



    protected function configureFormFields(\Sonata\AdminBundle\Form\FormMapper $form)
    {



        $form->add('login', TextType::class)
            ->add('nom', TextType::class)
            ->add('prenom', TextType::class)
            ->add('image', AdminType::class)
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

    /**
     * @param $object
     */
    public function prePersist($object)
    {
        //TODO: Code Review Needed
      /*  $image = new Image();
        $image->setFile($object->getImage()->getFile());
        $image->setName($this->fileUploader->upload($image->getFile()));
        $image->setUser($object);
        $object->setImage($image);*/
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

        $hashedDefaultPassword = $this->passwordEncoder->encodeUserPassword($object, $object->getDatenaissance()->format('Y-m-d h:i:s'));
        $object->setPassword($hashedDefaultPassword);
/*        $this->imageName = $this->uploadPhoto($object->getFile());

        $object->setPhoto($this->getImageName());
        dump($this->getImageName());
        die;*/
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
            ->add('role')
            ->add('metiers')
            ->add('services')
            ->add('taches');
    }




    private function manageEmbeddedImageAdmins($page)
    {
        foreach ($this->getFormFieldDescriptions() as $fieldName => $fieldDescription) {
            // detect embedded Admins that manage Images
            if ($fieldDescription->getType() === 'sonata_type_admin' &&
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
                    } elseif (!$image->getFile() && !$image->getName()) {
                        // prevent Sf/Sonata trying to create and persist an empty Image
                        $page->$setter(null);
                    }
                }
            }
        }
    }

}