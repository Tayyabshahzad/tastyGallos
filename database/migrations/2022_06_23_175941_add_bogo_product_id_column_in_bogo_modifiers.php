<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddBogoProductIdColumnInBogoModifiers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('bogo_modifiers', function (Blueprint $table) {
            $table->unsignedBigInteger('bogo_product_id');
            $table->foreign('bogo_product_id')->references('id')->on('bogo_products')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('bogo_modifiers', function (Blueprint $table) {
            //
        });
    }
}
