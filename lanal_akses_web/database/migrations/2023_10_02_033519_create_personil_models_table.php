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
            $table->string('nrp')->unique();
            $table->string('jabatan');
            $table->string('jenis_kelamin')->nullable();
            $table->string('pangkat')->nullable();
            $table->string('korps')->nullable();
            $table->string('pangkat_terakhir')->nullable();
            $table->string('tempat_dinas')->nullable();
            $table->string('tempat_armada')->nullable();
            $table->string('nomor_kta')->nullable();
            $table->string('nomor_ktp')->nullable();
            $table->string('nomor_asbri')->nullable();
            $table->string('tempat_lahir')->nullable();
            $table->string('tanggal_lahir')->nullable();
            $table->string('tinggi_badan')->nullable();
            $table->string('berat_badan')->nullable();
            $table->string('agama')->nullable();
            $table->string('suku_bangsa')->nullable();
            $table->string('golongan_darah')->nullable();
            $table->string('dikspesialisasi')->nullable();
            $table->string('nilai_samata_stakes')->nullable();
            $table->string('kecakapan_bahasa')->nullable();
            $table->string('alamat_sekarang')->nullable();
            $table->string('nomor_hp')->nullable();
            $table->string('status_rumah')->nullable();
            $table->string('image_url')->nullable();
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
