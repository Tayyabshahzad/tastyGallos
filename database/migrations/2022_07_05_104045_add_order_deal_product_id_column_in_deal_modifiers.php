<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddOrderDealProductIdColumnInDealModifiers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('deal_modifiers', function (Blueprint $table) {
            $table->unsignedBigInteger('order_deal_product_id');
            $table->foreign('order_deal_product_id')->references('id')->on('order_deal_products')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('deal_modifiers', function (Blueprint $table) {
            //
        });
    }
}
