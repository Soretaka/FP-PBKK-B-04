<?php

namespace Tests\Feature;

use App\Models\Member;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Testing\Fluent\AssertableJson;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\UploadedFile;
use Illuminate\Testing\TestResponse;

class MemberTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_welcome_status()
    {
        $response = $this->get('/member');

        $response->assertStatus(200);
    }

    public function test_input_status()
    {
        $response = $this->get('/member/input-form');

        $response->assertStatus(200);
    }

    public function test_images_can_be_uploaded()
    {
        Storage::fake('images');

        $file = UploadedFile::fake()->image('image.jpg');

        $response = $this->post('/image', [
            'image' => $file,
        ]);

        Storage::disk('images')->assertExists($file->hashName());
    }
}
