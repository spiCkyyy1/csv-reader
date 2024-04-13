<?php

namespace Tests\Feature;

use Illuminate\Http\UploadedFile;
use Tests\TestCase;

class FileUploadTest extends TestCase
{
    public function test_no_file_errors(): void
    {
        $response = $this->post('/upload-csv', [
            'csv' => null
        ]);
        $response->assertInvalid(['csv']);
    }

    public function test_validation_erors(): void
    {
        $file = UploadedFile::fake()->image('avatar.jpg');

        $response = $this->post('/upload-csv', [
            'csv' => $file,
        ]);

        $response->assertInvalid(['csv']);
    }

    public function test_passed_validation_erors(): void
    {
        $file = UploadedFile::fake()->image('avatar.csv');

        $response = $this->post('/upload-csv', [
            'csv' => $file,
        ]);

        $response->assertValid();
    }
}
