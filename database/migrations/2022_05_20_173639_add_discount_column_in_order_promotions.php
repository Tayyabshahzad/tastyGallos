<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDiscountColumnInOrderPromotions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('order_promotions', function (Blueprint $table) {
            $table->unsignedBigInteger('buy_product')->nullable();
            $table->foreign('buy_product')->references('id')->on('products')->onDelete('cascade');
            $table->string('discount_type')->nullable();
            $table->float('discount_amount')->default(0)->nullable();
            /// -- ///
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('order_promotions', function (Blueprint $table) {
            //
        });
    }
}
