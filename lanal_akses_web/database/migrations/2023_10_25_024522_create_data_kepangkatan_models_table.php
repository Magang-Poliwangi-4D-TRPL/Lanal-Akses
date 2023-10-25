<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDataKepangkatanModelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('data_kepangkatan', function (Blueprint $table) {
            $table->id();
            $table->string('pangkat');
            $table->string('no_skep');
            $table->string('tempat_pangkat');
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
        Schema::dropIfExists('data_kepangkatan');
    }
}
