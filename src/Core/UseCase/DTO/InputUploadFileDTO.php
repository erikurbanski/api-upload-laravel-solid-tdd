<?php

namespace Core\UseCase\DTO;

use Illuminate\Http\UploadedFile;

class InputUploadFileDTO
{
    /**
     * Define input transfer data to file.
     * @param UploadedFile $file
     */
    public function __construct(
        public UploadedFile $file,
    )
    {
    }
}