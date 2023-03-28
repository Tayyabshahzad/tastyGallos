<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePromotionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('promotions', function (Blueprint $table) {
            $table->id();
            $table->string('type');
            $table->date('start_date_time');
            $table->date('end_date_time');
            $table->enum('discount_type',['percentage','amount'])->nullable();
            $table->unsignedBigInteger('buy_product_id')->nullable();
            $table->unsignedBigInteger('get_product_id')->nullable();
            $table->float('amount')->nullable();
            $table->boolean('on_all_franchises');
            $table->enum('status',['active','inactive']);
            $table->foreign('buy_product_id')->references('id')->on('products')->onDelete('cascade');
            $table->foreign('get_product_id')->references('id')->on('products')->onDelete('cascade');
            $table->boolean('isCanceled')->default(false);
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('promotions');
    }
}
