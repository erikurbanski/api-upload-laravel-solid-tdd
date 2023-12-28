<?php

namespace Tests\Unit\UseCase\File;

use Mockery;
use stdClass;
use PHPUnit\Framework\TestCase;
use Illuminate\Http\UploadedFile;

use Core\UseCase\DTO\InputUploadFileDTO;
use Core\UseCase\DTO\OutputUploadFileDTO;
use Core\UseCase\File\UploadFileUseCase;

use Core\Domain\Entity\File;
use Core\Domain\Repository\FileRepositoryInterface;
use Core\Domain\Exception\EntityValidationException;

class UploadFileCaseUnitTest extends TestCase
{
    /**
     * Test use case to upload File.
     * @throws EntityValidationException
     */
    public function testUploadFile()
    {
        $fileName = 'file.pdf';
        $mockFileEntity = Mockery::mock(File::class, [
            $fileName,
            89563,
            'application/pdf',
            '.pdf',
            'files/file.pdf',
        ]);

        $mockFileEntity
            ->shouldReceive('name')
            ->andReturn($fileName);
        $mockFileEntity
            ->shouldReceive('size')
            ->andReturn($fileName);

        $mockFileRepository = Mockery::mock(stdClass::class, FileRepositoryInterface::class);
        $mockFileRepository
            ->shouldReceive('upload')
            ->andReturn($mockFileEntity);

        $mockUploadFileHttp = Mockery::mock(stdClass::class, UploadedFile::class);
        $mockUploadFileHttp
            ->shouldReceive('getClientOriginalName')
            ->andReturn($fileName);
        $mockUploadFileHttp
            ->shouldReceive('getSize')
            ->andReturn(89563);
        $mockUploadFileHttp
            ->shouldReceive('getClientMimeType');
        $mockUploadFileHttp
            ->shouldReceive('getClientOriginalExtension')
            ->andReturn();
        $mockUploadFileHttp
            ->shouldReceive('getPathname')
            ->andReturn();

        $mockRequestFileUploadDTO = Mockery::mock(InputUploadFileDTO::class, [$mockUploadFileHttp]);

        $fileUseCase = new UploadFileUseCase($mockFileRepository);
        $responseUseCase = $fileUseCase->execute($mockRequestFileUploadDTO);

        $this->assertInstanceOf(OutputUploadFileDTO::class, $responseUseCase);
        $this->assertEquals($fileName, $responseUseCase->name);

        Mockery::close();
    }
}
