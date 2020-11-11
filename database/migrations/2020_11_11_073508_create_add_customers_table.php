<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAddCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('add_customers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('dmform_id');
            $table->unsignedBigInteger('customer_id');
            $table->timestamps();
            $table->foreign('dmform_id')->references('id')->on('dmforms')->onDelete('cascade');
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
        Schema::dropIfExists('add_customers');
    }
}
