<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTakenProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('taken_products', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('dmform_id');
            $table->unsignedBigInteger('product_id');
            $table->integer('qty');
            $table->timestamps();
            $table->foreign('dmform_id')->references('id')->on('dmforms')->onDelete('cascade');
            $table->foreign('product_id')->references('id')->on('products');
        
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('taken_products');
    }
}
