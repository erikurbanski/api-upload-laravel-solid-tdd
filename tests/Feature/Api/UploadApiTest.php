<?php

namespace Tests\Feature\Api;

use Tests\TestCase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Response;

class UploadApiTest extends TestCase
{
    protected string $endpoint = '/api/upload';

    /**
     * Test create new author.
     * @return void
     */
    public function testUploadFile(): void
    {
        Storage::fake('local');
        $uploadedFile = UploadedFile::fake()->create('file.pdf');

        $params = ['file' => $uploadedFile];
        $response = $this->json('post', $this->endpoint, $params);

        $response->dump();
        $response->assertStatus(Response::HTTP_CREATED);
        $response->assertJsonStructure([
            'data' => [
                'name',
                'path'
            ],
        ]);
    }
}
