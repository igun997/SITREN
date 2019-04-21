<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSantri extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('santri', function (Blueprint $table) {
            //Peronal
            $table->string('id_santri')->primary();
            $table->string('nama_lengkap');
            $table->string('nama_panggilan')->nullable();
            $table->enum('jenis_kelamin',["laki-laki","perempuan"]);
            $table->string('tmpt_lhir');
            $table->date('tgl_lhr');
            $table->integer('anak_ke')->nullable();
            $table->integer('total_anak')->nullable();
            $table->enum('status_keluarga',["lengkap","yatim","piatu","yatim piatu","angkat"])->nullable();
            $table->string('bahasa_harian');
            //Ayah Ibu
            $table->string('nama_ayah')->nullable();
            $table->string('tmpt_lhir_ayah')->nullable();
            $table->date('tgl_lhir_ayah')->nullable();
            $table->text('alamat_lengkap_ayah')->nullable();
            $table->string('desa_ayah')->nullable();
            $table->string('kec_ayah')->nullable();
            $table->string('kota_ayah')->nullable();
            $table->string('prop_ayah')->nullable();
            $table->string('notelp_ayah')->nullable();
            $table->enum('penghasilan_ayah',["<1","1-2.5","5-10","10>"])->nullable();
            $table->enum('pendidikan_ayah',["SD","SMP","SMA","D1","D2","D3","D4","S1","S2","S3"])->nullable();
            $table->enum('pekerjaan_ayah',["PNS","TNI","PORLI","PENSIUNAN","BUMN/MD","TANI","DAGANG","WIRASWASTA","BURUH","SWASTA"])->nullable();
            $table->string('nama_ibu')->nullable();
            $table->string('tmpt_lhir_ibu')->nullable();
            $table->date('tgl_lhir_ibu')->nullable();
            $table->text('alamat_lengkap_ibu')->nullable();
            $table->string('desa_ibu')->nullable();
            $table->string('kec_ibu')->nullable();
            $table->string('kota_ibu')->nullable();
            $table->string('prop_ibu')->nullable();
            $table->string('notelp_ibu')->nullable();
            $table->enum('penghasilan_ibu',["<1","1-2.5","5-10","10>"])->nullable();
            $table->enum('pendidikan_ibu',["SD","SMP","SMA","D1","D2","D3","D4","S1","S2","S3"])->nullable();
            $table->enum('pekerjaan_ibu',["PNS","TNI","PORLI","PENSIUNAN","BUMN/MD","TANI","DAGANG","WIRASWASTA","BURUH","SWASTA"])->nullable();
            //Wali
            $table->string('nama_wali')->nullable();
            $table->string('tmpt_lhir_wali')->nullable();
            $table->date('tgl_lhir_wali')->nullable();
            $table->text('alamat_lengkap_wali')->nullable();
            $table->string('status_hubungan_wali')->nullable();

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
        Schema::dropIfExists('santri');
    }
}
