<?php

namespace Core\UseCase\DTO;

class OutputUploadFileDTO
{
    /**
     * Define output transfer data to file.
     * @param string $name
     * @param string $path
     */
    public function __construct(
        public string $name,
        public string $path,
    )
    {
    }
}