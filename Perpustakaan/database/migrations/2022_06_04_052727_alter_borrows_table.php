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
        Schema::table('borrows', function (Blueprint $table) {
            //
            $table->dropForeign('borrows_book_id_foreign');
            $table->dropColumn('book_id');
        });

        Schema::table('borrow_details', function (Blueprint $table) {
            //
            $table->unsignedBigInteger('book_id');
            $table->foreign('book_id')->references('id')->on('books')
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
        Schema::table('borrows', function (Blueprint $table) {
            //
            $table->unsignedBigInteger('book_id');
            $table->foreign('book_id')->references('id')->on('books')
                    ->onDelete('cascade')->onUpdate('cascade');
        });

        Schema::table('borrow_details', function (Blueprint $table) {
            //
            $table->dropForeign('borrow_details_book_id_foreign');
            $table->dropColumn('book_id');
        });
    }
};
