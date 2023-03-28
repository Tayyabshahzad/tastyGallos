<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderProductItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_product_items', function (Blueprint $table) {
            $table->id();
            $table->foreign('order_product_id')->references('id')->on('order_products')->onDelete('cascade');
            $table->unsignedBigInteger('order_product_id');
            $table->foreign('item_id')->references('id')->on('products')->onDelete('cascade');
            $table->unsignedBigInteger('item_id');
            $table->json('details')->nullable();
            $table->float('price');
            $table->timestamps();
        });
    }
    ///

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order_product_items');
    }
}
