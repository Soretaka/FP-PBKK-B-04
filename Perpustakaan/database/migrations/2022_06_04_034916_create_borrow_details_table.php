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
        Schema::create('borrow_details', function (Blueprint $table) {
            $table->id();
            $table->date('return_date');
            $table->decimal('denda');
            $table->timestamps();
        });

        Schema::table('borrow_details', function (Blueprint $table) {
            $table->unsignedBigInteger('borrow_id');

            $table->foreign('borrow_id')->references('id')->on('borrows')
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
        Schema::dropIfExists('borrow_details');
    }
};
