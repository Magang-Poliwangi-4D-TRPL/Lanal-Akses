<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePerlengkapanModelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('perlengkapan', function (Blueprint $table) {
            $table->id();
            $table->enum('baju', ['S', 'M', 'L', 'XL', 'XXL', 'XXXL']);
            $table->enum('celana', ['S', 'M', 'L', 'XL', 'XXL', 'XXXL']);
            $table->integer('no_sepatu');
            $table->integer('no_topi');
            $table->integer('no_mut');
            $table->string('keterangan')->nullable();
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
        Schema::dropIfExists('perlengkapan');
    }
}
