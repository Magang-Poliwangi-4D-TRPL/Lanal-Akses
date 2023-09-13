<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePersonilModelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('personil', function (Blueprint $table) {
            $table->id();
            $table->string('nama_lengkap');
            $table->string('nrp');
            $table->string('jabatan');
            $table->string('pangkat_korps')->nullable();
            $table->string('pangkat_terakhir')->nullable();
            $table->string('tempat_dinas')->nullable();
            $table->string('tempat_armada')->nullable();
            $table->string('nomor_kta')->nullable();
            $table->string('nomor_ktp')->nullable();
            $table->string('nomor_asbri')->nullable();
            $table->string('tempat_tanggalahir')->nullable();
            $table->string('agama_sukubangsa')->nullable();
            $table->string('golongan_darah')->nullable();
            $table->string('dikspesialisasi')->nullable();
            $table->string('nilai_samata_stakes')->nullable();
            $table->string('kecakapan_bahasa')->nullable();
            $table->string('alamat_sekarang')->nullable();
            $table->string('nomor_hp')->nullable();
            $table->string('status_rumah')->nullable();
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
        Schema::dropIfExists('personil');
    }
}
