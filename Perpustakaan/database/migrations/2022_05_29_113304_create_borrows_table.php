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
            $table->date('must_return_date');
            $table->timestamps();        
        });

        Schema::table('borrows', function (Blueprint $table) {
            $table->unsignedBigInteger('book_id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('admin_id');
            
            $table->foreign('book_id')->references('id')->on('books')
                    ->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('user_id')->references('id')->on('users')
                    ->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('admin_id')->references('id')->on('users')
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
