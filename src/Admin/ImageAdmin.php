<?php
/**
 * Created by PhpStorm.
 * User: heshamelarj
 * Date: 4/12/19
 * Time: 11:41 AM
 */

namespace App\Admin;


use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Form\FormMapper;
use Symfony\Component\Form\Extension\Core\Type\FileType;

class ImageAdmin extends AbstractAdmin
{
    public function configureFormFields(FormMapper $form)
    {
        $form->add('file',FileType::class,
        [
            'required'      =>      false
        ]);
    }

    public function prePersist($image)
    {

        $this->manageFileUpload($image);

    }
    public function preUpdate($image)
    {

    }

    public function manageFileUpload($image)
    {

        if($image->getFile())
        {
            $image->refreshUpload();
        }
    }
}