<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAddCustomerarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('add_customerars', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('dmaddreturn_id');
            $table->unsignedBigInteger('customer_id');
            $table->timestamps();
            $table->foreign('dmaddreturn_id')->references('id')->on('dmaddreturns')->onDelete('cascade');
            $table->foreign('customer_id')->references('id')->on('customers');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('add_customerars');
    }
}
