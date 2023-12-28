<?php

namespace Tests\Unit\Domain\Entity;

use Throwable;
use PHPUnit\Framework\TestCase;

use Core\Domain\Entity\File;
use Core\Domain\Exception\EntityValidationException;

class FileUnitTest extends TestCase
{
    /**
     * Test file attributes.
     * @return void
     * @throws EntityValidationException
     */
    public function testAttributes(): void
    {
        $author = new File(
            name: 'file.pdf',
            size: 18508,
            mimeType: 'application/pdf',
            extension: '.pdf',
            path: 'path/file.pdf',
        );

        $this->assertEquals('file.pdf', $author->name);
    }

    /**
     * Test update data file.
     * @return void
     * @throws EntityValidationException
     */
    public function testUpdate(): void
    {
        $author = new File(
            name: 'file.pdf',
            size: 18508,
            mimeType: 'application/pdf',
            extension: '.pdf',
            path: 'path/file.pdf',
        );

        $author->update(
            name: 'file_update.pdf',
            path: 'path/file_update.pdf',
        );

        $this->assertEquals('file_update.pdf', $author->name);
        $this->assertEquals('path/file_update.pdf', $author->path);
    }

    /**
     * Test validation rules to file name.
     * @return void
     */
    public function testExceptionNameFile(): void
    {
        try {
            new File(
                name: '',
                size: 18508,
                mimeType: 'application/pdf',
                extension: '.pdf',
                path: 'path/file.pdf',
            );
            $this->fail();
        } catch (Throwable $th) {
            $this->assertInstanceOf(EntityValidationException::class, $th);
        }
    }
}
