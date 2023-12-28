<?php

namespace Core\Domain\Entity;

use Core\Domain\Validation\DomainValidation;
use Core\Domain\Entity\Traits\MethodsMagicsTrait;
use Core\Domain\Exception\EntityValidationException;

class File
{
    use MethodsMagicsTrait;

    /**
     * Constructor class.
     * @param string $name
     * @param int $size
     * @param string $mimeType
     * @param string $extension
     * @param string|null $path
     * @throws EntityValidationException
     */
    public function __construct(
        protected string  $name,
        protected int     $size,
        protected string  $mimeType,
        protected string  $extension,
        protected ?string $path,
    )
    {
        $this->validate();
    }

    /**
     * Update data file.
     * @param string $name
     * @param string $path
     * @return void
     * @throws EntityValidationException
     */
    public function update(string $name, string $path): void
    {
        $this->name = $name;
        $this->path = $path;
        $this->validate();
    }

    /**
     * Validate file.
     * @return void
     * @throws EntityValidationException
     */
    private function validate(): void
    {
        DomainValidation::notNull($this->name);
    }
}