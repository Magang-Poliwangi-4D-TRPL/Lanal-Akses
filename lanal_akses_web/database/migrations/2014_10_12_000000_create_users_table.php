<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('nama_lengkap');
            $table->string('username')->unique();
            $table->string('password');
            $table->enum('role', ['komandan', 'pasintel', 'paspotmar', 'paset', 'personel', 'pegawai'])->default('paset');
            $table->rememberToken();
            $table->timestamps();

            // Definisikan foreign key constraint
            $table->foreignId('personil_id')->nullable();
            $table->foreignId('pegawai_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
