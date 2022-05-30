<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::enableForeignKeyConstraints();
        Schema::create('borrows', function (Blueprint $table) {
            $table->id();
            $table->string('isbn');
            $table->date('tanggal_peminjaman');
            $table->date('tanggal_kembali');
            $table->timestamps();
        });
        Schema::table('borrows', function (Blueprint $table) {
            $table->unsignedBigInteger('buku_id');
         
            $table->foreign('buku_id')->references('id')->on('books')
                    ->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('borrows');
    }
};
