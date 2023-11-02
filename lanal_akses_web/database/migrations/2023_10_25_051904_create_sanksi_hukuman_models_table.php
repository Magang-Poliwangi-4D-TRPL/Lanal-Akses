<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSanksiHukumanModelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sanksi_hukuman', function (Blueprint $table) {
            $table->id();
            $table->string('nama_hukuman');
            $table->string('tahun_hukuman');
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
        Schema::dropIfExists('sanksi_hukuman');
    }
}
