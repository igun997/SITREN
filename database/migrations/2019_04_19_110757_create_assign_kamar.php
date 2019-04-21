<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAssignKamar extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('assign_kamar', function (Blueprint $table) {
          $table->bigIncrements('id_akr');
          $table->bigInteger('id_kamar')->unsigned();
          $table->string('id_santri');
          $table->foreign('id_kamar')
          ->references('id_kamar')->on('kamar')
          ->onDelete('cascade');
          $table->foreign('id_santri')
          ->references('id_santri')->on('santri')
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
        Schema::dropIfExists('assign_kamar');
    }
}
