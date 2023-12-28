<?php

namespace App\Repositories\Upload;

use Core\Domain\Exception\EntityValidationException;
use Illuminate\Http\UploadedFile;

use Core\Domain\Entity\File;
use Core\Domain\Repository\FileRepositoryInterface;

class UploadLocalRepository implements FileRepositoryInterface
{
    /**
     * Constructor class.
     * @param string $disk
     */
    public function __construct(
        protected string $disk = 'public',
    )
    {
    }

    /**
     * Upload file.
     * @param File $file
     * @param UploadedFile $uploadedFile
     * @param string $folder
     * @return File
     * @throws EntityValidationException
     */
    public function upload(File $file, UploadedFile $uploadedFile, string $folder): File
    {
        $fileName = now()->timestamp . '-' . $file->name;
        $storePath = $uploadedFile->storeAs(
            path: $folder,
            name: $fileName,
            options: $this->disk,
        );

        $file->update($fileName, $storePath);

        return $file;
    }
}