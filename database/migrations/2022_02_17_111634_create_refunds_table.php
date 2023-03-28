<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRefundsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('refunds', function (Blueprint $table) {
            $table->id();
            $table->foreign('order_id')->references('id')->on('orders')->onDelete('cascade');
            $table->unsignedBigInteger('order_id');
            $table->foreign('franchise_id')->references('id')->on('franchises')->onDelete('cascade');
            $table->unsignedBigInteger('franchise_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->unsignedBigInteger('user_id');
            $table->foreign('act_by')->references('id')->on('users')->onDelete('cascade');
            $table->unsignedBigInteger('act_by')->nullable();
            $table->date('date');
            $table->text('reason');
            $table->text('cancel_reason')->nullable();
            $table->enum('status',['pending','refunded','cancelled']);
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
        Schema::dropIfExists('refunds');
    }
}
