<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInformasiOrangTuaModelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('informasi_orang_tua', function (Blueprint $table) {
            $table->id(); 
            $table->string('nama_lengkap');
            $table->string('agama');
            $table->enum('status_hubungan', ['Ayah Kandung', 'Ibu Kandung', 'Ayah Mertua', 'Ibu Mertua'])->default('Ayah Kandung')->nullable();
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
        Schema::dropIfExists('informasi_orang_tua');
    }
}
