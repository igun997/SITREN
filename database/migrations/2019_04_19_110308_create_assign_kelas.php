<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAssignKelas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('assign_kelas', function (Blueprint $table) {
          $table->bigIncrements('id_aks');
          $table->bigInteger('id_kelas')->unsigned();
          $table->string('id_santri');
          $table->foreign('id_kelas')
          ->references('id_kelas')->on('kelas')
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
        Schema::dropIfExists('assign_kelas');
    }
}
