<?php

namespace App\Http\Controllers;


use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

use App\Http\Requests\UploadRequest;
use App\Http\Resources\UploadResource;

use Core\UseCase\File\UploadFileUseCase;
use Core\UseCase\DTO\InputUploadFileDTO;
use Core\Domain\Exception\EntityValidationException;

class UploadController extends Controller
{
    /**
     * Upload file.
     * @param UploadRequest $request
     * @param UploadFileUseCase $useCase
     * @return JsonResponse
     * @throws EntityValidationException
     */
    public function upload(UploadRequest $request, UploadFileUseCase $useCase): JsonResponse
    {
        $file = $request->file(key: 'file');

        $response = $useCase->execute(
            input: new InputUploadFileDTO(
                file: $file,
            ),
        );

        $resource = new UploadResource($response);
        return $resource
            ->response()
            ->setStatusCode(code: Response::HTTP_CREATED);
    }
}
