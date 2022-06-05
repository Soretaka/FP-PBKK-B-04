<?php

namespace Tests\Unit\Category;

use Tests\TestCase;

class CategoryControllerTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_store_data_successfully_category()
    {
        $response = $this->post('/category/store', [
            'kategori_buku' => 'category_test'
        ]);

        $response->assertStatus(302);
        $response->assertRedirect('/category');
    }

    public function test_store_data_failed_category()
    {
        $response = $this->post('/category/store', [
            'kategori_buku' => 'category_test'
        ]);

        $response->assertStatus(302);
        $response->assertRedirect('/');
    }
}
