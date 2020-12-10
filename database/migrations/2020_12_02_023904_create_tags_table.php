<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTagsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tags', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('running_number')->nullable();
            $table->unsignedBigInteger('dmforms_id')->nullable();
            $table->unsignedBigInteger('dmaddreturns_id')->nullable();
            $table->string('status');
            $table->timestamp('finalized_at')->nullable();
            $table->foreign('dmforms_id')->references('id')->on('dmforms');
            $table->foreign('dmaddreturns_id')->references('id')->on('dmaddreturns');
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
        Schema::dropIfExists('tags');
    }
}
