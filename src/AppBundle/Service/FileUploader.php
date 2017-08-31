<?php

namespace AppBundle\Service;

use Symfony\Component\HttpFoundation\File\UploadedFile;

class FileUploader
{

    public function upload($targetDir, UploadedFile $file, $name)
    {
        $file->move($targetDir, $name);
    }

    public function generateFileName(UploadedFile $file)
    {
        $fileName = md5(uniqid()).'.'.$file->guessExtension();
        return $fileName;
    }

}