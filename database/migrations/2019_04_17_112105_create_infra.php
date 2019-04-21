<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInfra extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('infra', function (Blueprint $table) {
          $table->bigIncrements('id_infra');
          $table->string('nama_infra');
          $table->bigInteger('id_katinfra')->unsigned();
          $table->timestamps();
          $table->foreign('id_katinfra')
          ->references('id_katinfra')->on('katinfra')
          ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('infra');
    }
}
