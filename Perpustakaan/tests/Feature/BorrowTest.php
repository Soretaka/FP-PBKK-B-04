<?php

namespace Tests\Feature;

use App\Models\Borrow;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Testing\Fluent\AssertableJson;
use Illuminate\Testing\TestResponse;

class BorrowTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_welcome_status()
    {
        $response = $this->get('/borrow');

        $response->assertStatus(200);
    }

    public function test_input_status()
    {
        $response = $this->get('/borrow/input-form');

        $response->assertStatus(200);
    }
}
