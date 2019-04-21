<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIjin extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ijin', function (Blueprint $table) {
          $table->string('id_ijin')->primary();
          $table->string('id_santri');
          $table->bigInteger('id_pengurus')->unsigned();
          $table->text('tujuan_ijin');
          $table->dateTime('waktu_start');
          $table->dateTime('waktu_end');
          $table->dateTime('waktu_keluar')->nullable();
          $table->dateTime('waktu_kembali')->nullable();
          $table->bigInteger('penerima_keluar')->unsigned()->nullable();
          $table->bigInteger('penerima_masuk')->unsigned()->nullable();
          $table->enum('status_ijin',["dibuat","keluar","selesai","dibatalkan"]);
          $table->timestamps();
          $table->foreign('id_santri')
          ->references('id_santri')->on('santri')
          ->onDelete('cascade');
          $table->foreign('id_pengurus')
          ->references('id_pengurus')->on('pengurus')
          ->onDelete('cascade');
          $table->foreign('penerima_keluar')
          ->references('id_pengurus')->on('pengurus')
          ->onDelete('cascade');
          $table->foreign('penerima_masuk')
          ->references('id_pengurus')->on('pengurus')
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
        Schema::dropIfExists('ijin');
    }
}
