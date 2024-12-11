<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateResponCutiModelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('respon_cuti', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pengajuan_cuti_id');
            $table->foreignId('atasan_id');
            $table->string('status_atasan')->default('Menunggu Persetujuan');
            $table->string('keterangan_atasan')->nullable();
            $table->foreignId('palaksa_id');
            $table->string('status_palaksa')->default('Menunggu Persetujuan');
            $table->string('keterangan_palaksa')->nullable();
            $table->foreignId('sekretaris_id');
            $table->string('status_sekretaris')->default('Menunggu Persetujuan');
            $table->string('keterangan_sekretaris')->nullable();
            $table->foreignId('komandan_id');
            $table->string('status_komandan')->default('Menunggu Persetujuan');
            $table->string('keterangan_komandan')->nullable();
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
        Schema::dropIfExists('respon_cuti');
    }
}
