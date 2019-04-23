<?php

namespace App\Entity;

use App\Service\FileUploader;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ImageRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class Image
{


const PATH_TO_UPLOADS_DIR = 'uploads/profile_images';
const FULLPATH_TO_IMAGES_DIR = '/uploads/profile_images';
const EMPLOYEE_PHOTO_PROFILE_PLACEHOLDER_DIR = '/assets/img/placeholder.png';

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;
    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @var $file UploadedFile unmapped field to hold the files
     */
    private $file;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $updated;
    /**
     * @ORM\OneToOne(targetEntity="App\Entity\User", inversedBy="image")
     */
    private $user;
    public function setName(string $Name): self
    {
        $this->name = $Name;


        return $this;
    }

    /**
     * @return UploadedFile
     */
    public function getFile(): ?UploadedFile
    {

        return $this->file;
    }

    /**
     * @param UploadedFile $file
     */
    public function setFile(UploadedFile $file = null ): void
    {
        $this->file = $file;
    }



    public function refreshUpdated()
    {
        $this->setUpdated(new \DateTime());
    }

    /**
     * @return mixed
     */
    public function getUpdated()
    {
        return $this->updated;
    }

    /**
     * @param mixed $updated
     */
    public function setUpdated($updated): void
    {
        $this->updated = $updated;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param mixed $user
     */
    public function setUser($user): void
    {
        $this->user = $user;
    }

    /**
     * @ORM\PreUpdate
     * @ORM\PrePersist
     */
    public function upload()
    {

       if(null === $this->getFile()) return;
        $fileName = md5(uniqid()).'.'.$this->getFile()->guessExtension();
       $this->name = $fileName;
       $this->getFile()->move(
           self::PATH_TO_UPLOADS_DIR,
           $fileName
       );
        $this->setFile(null);

    }




    public function getWebPath()
    {
        return self::FULLPATH_TO_IMAGES_DIR.'/'.$this->getName();
    }
    public  static function getPhotoPlaceholder()
    {
        return self::EMPLOYEE_PHOTO_PROFILE_PLACEHOLDER_DIR;
    }
}
