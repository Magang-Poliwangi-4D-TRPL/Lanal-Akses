<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInformasiPasanganModelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('informasi_pasangan', function (Blueprint $table) {
            $table->id();
            $table->string('nama_lengkap');
            $table->string('tempat_lahir')->nullable();
            $table->string('tanggal_lahir')->nullable();
            $table->string('agama')->nullable();
            $table->string('suku_bangsa')->nullable();
            $table->string('tinggi_badan')->nullable();
            $table->string('berat_badan')->nullable();
            $table->string('golongan_darah')->nullable();
            $table->string('pekerjaan')->nullable();
            $table->string('alamat_sekarang')->nullable();
            $table->string('nomor_kpi')->nullable();
            $table->string('tempat_nikah')->nullable();
            $table->string('nomor_surat_nikah')->nullable();
            $table->string('nomor_kta_jalasenastri')->nullable();
            $table->timestamps();
            
            // Definisikan foreign key constraint
            $table->foreignId('personil_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('informasi_pasangan');
    }
}
