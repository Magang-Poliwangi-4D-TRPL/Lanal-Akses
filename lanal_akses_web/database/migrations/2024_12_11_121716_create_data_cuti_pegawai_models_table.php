<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDataCutiPegawaiModelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('data_cuti_pegawai', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pegawai_id');
            $table->foreignId('cuti_id');
            $table->foreignId('pengajuan_cuti_id');
            $table->integer('jumlah_hari');
            $table->date('tanggal_mulai');
            $table->date('tanggal_selesai');
            $table->string('keterangan')->nullable();
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
        Schema::dropIfExists('data_cuti_pegawai');
    }
}
