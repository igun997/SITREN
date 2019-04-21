<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAssignWalikamar extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('assign_walikamar', function (Blueprint $table) {
            $table->bigIncrements('id_awr');
            $table->bigInteger('id_kamar')->unsigned();
            $table->bigInteger('id_pengurus')->unsigned();
            $table->foreign('id_pengurus')
            ->references('id_pengurus')->on('pengurus')
            ->onDelete('cascade');
            $table->foreign('id_kamar')
            ->references('id_kamar')->on('kamar')
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
        Schema::dropIfExists('assign_walikamar');
    }
}
