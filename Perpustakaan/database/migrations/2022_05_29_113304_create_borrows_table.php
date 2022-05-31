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
            // $table->foreignId('book_id');
            // $table->foreignId('user_id');
            $table->date('tanggal_peminjaman');
            $table->date('tanggal_kembali');
            $table->timestamps();        
        });
        Schema::table('borrows', function (Blueprint $table) {
            $table->unsignedBigInteger('book_id');
            $table->unsignedBigInteger('user_id');
            $table->foreign('book_id')->references('id')->on('books')
                    ->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('user_id')->references('id')->on('users')
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
