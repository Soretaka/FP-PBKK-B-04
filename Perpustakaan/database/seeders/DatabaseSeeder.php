<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        DB::table('users')->insert([
            'name' => 'Test Admin',
            'email' => 't0@a.c',
            'password' =>  bcrypt('test1234'),
            'isAdmin' => '1',
            'TL' => '2022-05-09',
            'Alamat' => 'Surabaya',
            'JK' => 'L',
            'NIS' => '132'
        ]);
        DB::table('users')->insert([
            'name' => 'Test User',
            'email' => 't1@a.c',
            'password' =>  bcrypt('test1234'),
            'isAdmin' => '0',
            'TL' => '2022-05-09',
            'Alamat' => 'Surabaya',
            'JK' => 'L',
            'NIS' => '132'
        ]);
        DB::table('categories')->insert([
            'kategori_buku' => 'Fantasi'
        ]);
        DB::table('books')->insert([
            'image' => 'book-image/percy.jpg',
            'judul' => 'Percy Jackson',
            'penulis' => 'Rick Riordan',
            'penerbit' => 'Gramedia',
            'tahun_terbit' => '2019',
            'isbn' => '11123412',
            'status' => 'Tersedia',
            'kategori_id' => '1'
        ]);
        DB::table('categories')->insert([
            'kategori_buku' => 'Pelajaran'
        ]);
        DB::table('categories')->insert([
            'kategori_buku' => 'Komedi'
        ]);
        DB::table('books')->insert([
            'image' => 'book-image/marmut.jpg',
            'judul' => 'Marmut Merah Jambu',
            'penulis' => 'Raditya Dika',
            'penerbit' => 'Tokyo',
            'tahun_terbit' => '2012',
            'isbn' => '2131412',
            'status' => 'Tersedia',
            'kategori_id' => '3'
        ]);
        DB::table('books')->insert([
            'image' => 'book-image/science_book.jpg',
            'judul' => 'Buku IPA',
            'penulis' => 'PGRI Denpasar',
            'penerbit' => 'Pemerintah',
            'tahun_terbit' => '2012',
            'isbn' => '3141223',
            'status' => 'Tersedia',
            'kategori_id' => '2'
        ]);
    }
}
