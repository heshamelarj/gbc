<?php
/**
 * Created by PhpStorm.
 * User: heshamelarj
 * Date: 4/12/19
 * Time: 11:41 AM
 */

namespace App\Admin;


use App\Entity\Image;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Form\FormMapper;
use Symfony\Component\Form\Extension\Core\Type\FileType;

class ImageAdmin extends AbstractAdmin
{
    public function configureFormFields(FormMapper $form)
    {


        if($this->hasParentFieldDescription())
        {
            $getter = 'get' . $this->getParentFieldDescription()->getFieldName();

            $parent = $this->getParentFieldDescription()->getAdmin()->getSubject();
            if($parent)
            {
                $image = $parent->$getter();
            }else
            {
                $image = null;
            }
        }else
        {
            $image = $this->getSubject();
        }
        $fileFieldOptions = ['required' =>  false];
        if($image && ($webPath = $image->getWebPath()))
        {

            $fileFieldOptions['help'] = '<img src="'.$webPath.'" class="image-preview" id="employeImageUpload"/>';

        }else
        {
            $fileFieldOptions['help'] = '<img src="'.Image::getPhotoPlaceholder().'" class="image-preview" id="employeImageUpload"/>';
        }
        $form->add('file',FileType::class,$fileFieldOptions);
    }

}