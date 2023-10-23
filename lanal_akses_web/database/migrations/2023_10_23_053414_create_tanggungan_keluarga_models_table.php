<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTanggunganKeluargaModelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tanggungan_keluarga', function (Blueprint $table) {
            $table->id();
            $table->string('nama_lengkap');
            $table->string('tempat_tanggal_lahir');
            $table->enum('status_hubungan', ['suami', 'istri', 'anak'])->default('anak');
            $table->string('keterangan')->nullable();
            $table->timestamps();

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
        Schema::dropIfExists('tanggungan_keluarga');
    }
}
