<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePengajuanCutiModelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pengajuan_cuti', function (Blueprint $table) {
            $table->id();
            $table->string('nomor_surat')->nullable();
            $table->foreignId('personil_id');
            $table->date('tanggal_mulai_cuti');
            $table->date('tanggal_selesai_cuti');
            $table->foreignId('cuti_id');
            $table->enum('status', ['Menunggu Persetujuan', 'Disetujui Atasan', 'Disetujui Palaksa', 'Disetujui Komandan' , 'Disetujui Sekretaris', 'Ditolak', 'Arsip']);
            $table->string('alasan_cuti')->nullable();
            $table->string('no_telepon');
            $table->string('alamat_cuti')->nullable();
            $table->foreignId('atasan_id');
            $table->string('jenis_cuti');
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
        Schema::dropIfExists('pengajuan_cuti');
    }
}
