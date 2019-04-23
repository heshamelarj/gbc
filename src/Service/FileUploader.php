<?php
/**
 * Created by PhpStorm.
 * User: heshamelarj
 * Date: 4/10/19
 * Time: 12:22 PM
 */


namespace App\Service;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class FileUploader
{
    private  $targetDirectory;

    public function __construct($targetDirectory)
    {
        $this->targetDirectory = $targetDirectory;
    }

    /**
     * @param UploadedFile $file
     * @return string
     */
    public function upload(UploadedFile $file) : string
    {
        if(!$this->verifyUploadedImageFileExtension($file)) return null;
        $fileName = md5(uniqid()).'.'.$file->guessExtension();
        try{
            $file->move(
                $this->getTargetDirectory(),$fileName
            );
        }catch(FileException $e) {
            //TODO (heshamelarj): handle this error

        }
        return $fileName;
    }

    /**
     * @param UploadedFile $fileToVerify
     * @return bool
     */
    public function verifyUploadedImageFileExtension(UploadedFile $fileToVerify) : bool
    {
        if($this->checkImageExtentionRegEx($fileToVerify->guessExtension())) return true;
        return false;
    }

    /**
     * @param $fileExtension
     * @return bool
     */
    public function checkImageExtentionRegEx($fileExtension) : bool
    {
        $regPattern = '/(jpeg|png|svg|jpg)/';

        if(preg_match($regPattern, $fileExtension)) return true;
        return false;
    }

    /**
     * @return mixed
     */
    public  function getTargetDirectory()
    {
        return $this->targetDirectory;
    }

}