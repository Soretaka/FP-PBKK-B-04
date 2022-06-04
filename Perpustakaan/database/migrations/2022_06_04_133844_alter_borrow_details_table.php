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
        Schema::table('borrow_details', function (Blueprint $table) {
            //
            $table->dropColumn('return_date');
            $table->dropColumn('denda');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('borrow_details', function (Blueprint $table) {

            $table->date('return_date');
            $table->decimal('denda');
        });
    }
};
