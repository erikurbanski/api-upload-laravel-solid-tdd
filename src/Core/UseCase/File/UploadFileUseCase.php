<?php

namespace Core\UseCase\File;

use Core\Domain\Entity\File;
use Core\Domain\Exception\EntityValidationException;
use Core\Domain\Repository\FileRepositoryInterface;

use Core\UseCase\DTO\InputUploadFileDTO;
use Core\UseCase\DTO\OutputUploadFileDTO;

class UploadFileUseCase
{
    /**
     * Constructor class.
     * @param FileRepositoryInterface $repository
     */
    public function __construct(
        protected FileRepositoryInterface $repository
    )
    {
    }

    /**
     * Execute the upload file.
     * @param InputUploadFileDTO $input
     * @return OutputUploadFileDTO
     * @throws EntityValidationException
     */
    public function execute(InputUploadFileDTO $input): OutputUploadFileDTO
    {
        $file = new File(
            name: $input->file->getClientOriginalName(),
            size: $input->file->getSize(),
            mimeType: $input->file->getClientMimeType(),
            extension: $input->file->getClientOriginalExtension(),
            path: $input->file->getPathname(),
        );

        $uploadedFile = $this->repository->upload($file, $input->file, 'files');

        return new OutputUploadFileDTO(
            name: $uploadedFile->name,
            path: $uploadedFile->path,
        );
    }
}