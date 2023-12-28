<?php

namespace Tests\Feature\App\Http\Controller;

use App\Http\Controllers\UploadController;
use App\Http\Requests\UploadRequest;
use App\Repositories\Upload\UploadLocalRepository;
use Core\UseCase\File\UploadFileUseCase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\ParameterBag;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

use Core\UseCase\Author\GetAuthorUseCase;
use Core\UseCase\Author\ListAuthorsUseCase;
use Core\UseCase\Author\CreateAuthorUseCase;
use Core\UseCase\Author\UpdateAuthorUseCase;
use Core\UseCase\Author\DeleteAuthorUseCase;
use Core\Domain\Exception\EntityValidationException;


class UploadControllerTest extends TestCase
{
    protected UploadController $controller;
    protected UploadLocalRepository $repository;

    /**
     * Initialize config tests.
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $this->controller = new UploadController();
        $this->repository = new UploadLocalRepository('public');
    }

    /**
     * Test upload controller.
     * @return void
     * @throws EntityValidationException
     */
    public function testUpload(): void
    {
        $useCase = new UploadFileUseCase($this->repository);
        $request = new UploadRequest();

        Storage::fake('local');
        $uploadedFile = UploadedFile::fake()->create('file.pdf');

        $request->headers->set('accept', 'application/json');
        $request->headers->set('content-type', 'multipart/form-data');

        $request->files->set('file', $uploadedFile);

        $response = $this->controller->upload($request, $useCase);

        $this->assertInstanceOf(JsonResponse::class, $response);
        $this->assertEquals(Response::HTTP_CREATED, $response->status());
    }
}
