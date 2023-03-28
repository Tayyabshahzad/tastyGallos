<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFranchisesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('franchises', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('name')->unique();
            $table->string('contact_phone');
            $table->string('contact_email');
            $table->string('vat');
            $table->string('lat')->nullable();
            $table->string('lng')->nullable();
            $table->text('address')->nullable();
            $table->float('delivery_charge')->default(0);
            $table->boolean('pickup')->nullable();
            $table->boolean('delivery')->nullable();
            $table->text('about')->nullable();
            $table->integer('busy_time');
            $table->integer('free_time');
            $table->string('bank')->nullable();
            $table->string('account_holder')->nullable();
            $table->string('branch')->nullable();
            $table->string('account_number')->nullable();
            $table->enum('status',['active','inactive']);
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
        Schema::dropIfExists('franchises');
    }
}
