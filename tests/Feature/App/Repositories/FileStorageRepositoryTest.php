<?php

namespace Tests\Feature\App\Repositories;

use Tests\TestCase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

use Core\Domain\Entity\File;
use Core\Domain\Repository\FileRepositoryInterface;
use Core\Domain\Exception\EntityValidationException;
use App\Repositories\Upload\UploadLocalRepository;

class FileStorageRepositoryTest extends TestCase
{
    protected UploadLocalRepository $repository;

    /**
     * Constructor of tests.
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        $this->repository = new UploadLocalRepository('public');
    }

    /**
     * Test upload.
     * @return void
     * @throws EntityValidationException
     */
    public function testUpload(): void
    {
        $file = new File(
            name: 'file.pdf',
            size: 18508,
            mimeType: 'application/pdf',
            extension: '.pdf',
            path: 'path/file.pdf',
        );

        Storage::fake('local');
        $uploadedFile = UploadedFile::fake()->create('file.pdf');

        $response = $this->repository->upload(
            file: $file,
            uploadedFile: $uploadedFile,
            folder: 'files',
        );

        $this->assertInstanceOf(FileRepositoryInterface::class, $this->repository);
        $this->assertInstanceOf(File::class, $response);
    }
}
