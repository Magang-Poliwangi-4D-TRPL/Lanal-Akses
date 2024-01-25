<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWaktuKerjaModelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('waktu_kerja', function (Blueprint $table) {
            $table->id();
            $table->string('nama_waktu_kerja');
            $table->time('jam_masuk_mulai');
            $table->time('jam_masuk_selesai');
            $table->time('jam_pulang_mulai');
            $table->time('jam_pulang_selesai');
            $table->time('jam_istirahat_mulai')->nullable();
            $table->time('jam_istirahat_selesai')->nullable();
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
        Schema::dropIfExists('waktu_kerja');
    }
}
