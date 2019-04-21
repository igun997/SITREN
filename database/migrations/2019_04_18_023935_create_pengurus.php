<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePengurus extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pengurus', function (Blueprint $table) {
          $table->bigIncrements('id_pengurus');
          $table->bigInteger('id')->unsigned();
          $table->bigInteger('id_pegawai')->unsigned()->nullable();
          $table->string('id_santri')->index()->nullable();
          $table->timestamps();
          $table->foreign('id')
          ->references('id')->on('users')
          ->onDelete('cascade');
          $table->foreign('id_pegawai')
          ->references('id_pegawai')->on('pegawai')
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
        Schema::dropIfExists('pengurus');
    }
}
