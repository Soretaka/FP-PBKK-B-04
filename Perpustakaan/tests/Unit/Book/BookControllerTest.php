<?php

namespace Tests\Unit\Book;

use Tests\TestCase;

class BookControllerTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_store_data_successfully_book()
    {
        $response = $this->post('/book/store', [
            'image' => 'image.jpg',
            'judul' => 'book_test',
            'penulis' => 'writer_test',
            'penerbit' => 'publisher_test',
            'tahun_terbit' => '2000',
            'isbn' => '729',
            'status' => 'Tersedia',
            'kategori_id' => 1
        ]);

        $response->assertStatus(302);
        $response->assertRedirect('/book');
    }

    public function test_store_data_failed_book()
    {
        $response = $this->post('/book/store', [
            'image' => '',
            'judul' => '',
            'penulis' => '',
            'penerbit' => '',
            'tahun_terbit' => '',
            'isbn' => '',
            'status' => '',
            'kategori_id' => ''
        ]);

        $response->assertStatus(302);
        $response->assertRedirect('/');
    }
}
