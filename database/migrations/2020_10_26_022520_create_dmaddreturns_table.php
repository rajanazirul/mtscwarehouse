<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDmaddreturnsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dmaddreturns', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('purpose_id')->nullable();
            $table->unsignedBigInteger('user_id');
            $table->string('dono');
            $table->string('invno');
            $table->timestamp('finalized_at')->nullable();
            $table->string('status')->nullable();
            $table->foreign('purpose_id')->references('id')->on('purposes');
            $table->foreign('user_id')->references('id')->on('users');
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
        Schema::dropIfExists('dmaddreturns');
    }
}
