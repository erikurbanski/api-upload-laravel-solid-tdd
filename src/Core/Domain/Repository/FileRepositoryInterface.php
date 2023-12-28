<?php

namespace Core\Domain\Repository;

use Core\Domain\Entity\File;
use Illuminate\Http\UploadedFile;

interface FileRepositoryInterface
{
    public function upload(File $file, UploadedFile $uploadedFile, string $folder): File;
}