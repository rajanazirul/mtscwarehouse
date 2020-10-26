<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAddreturnProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('addreturn_products', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('dmaddreturn_id');
            $table->unsignedBigInteger('product_id');
            $table->integer('stock');
            $table->foreign('dmaddreturn_id')->references('id')->on('dmaddreturns')->onDelete('cascade');
            $table->foreign('product_id')->references('id')->on('products');
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
        Schema::dropIfExists('addreturn_products');
    }
}
