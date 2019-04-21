<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransaksi extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaksi', function (Blueprint $table) {
            $table->string('id_transaksi')->primary();
            $table->string("id_santri");
            $table->enum("jenis",["keluar","masuk","biaya_transfer","biaya_admin"]);
            $table->double("jumlah");
            $table->bigInteger("id_pengurus")->unsigned();
            $table->timestamps();
            $table->foreign('id_santri')
            ->references('id_santri')->on('santri')
            ->onDelete('cascade');
            $table->foreign('id_pengurus')
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
        Schema::dropIfExists('transaksi');
    }
}
