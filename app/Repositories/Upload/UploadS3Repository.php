<?php

namespace App\Repositories\Upload;

use Core\Domain\Entity\File;
use Core\Domain\Repository\FileRepositoryInterface;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class UploadS3Repository implements FileRepositoryInterface
{
    /**
     * Constructor class.
     * @param Storage $storage
     */
    public function __construct(
        protected Storage $storage
    )
    {
    }

    /**
     * Upload files in S3.
     * @param File $file
     * @param UploadedFile $uploadedFile
     * @param string $folder
     * @return File
     */
    public function upload(File $file, UploadedFile $uploadedFile, string $folder): File
    {
    }
}