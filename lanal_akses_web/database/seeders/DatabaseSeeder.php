<?php

namespace Database\Seeders;

use App\Models\DataKepangkatanModel;
use App\Models\KursusModel;
use App\Models\PegawaiModel;
use App\Models\PendidikanFormalModel;
use App\Models\PendidikanMiliterModel;
use App\Models\PerlengkapanModel;
use App\Models\PersonilModel;
use App\Models\RiwayatPenugasanModel;
use App\Models\SanksiHukumanModel;
use App\Models\TandaJasaModel;
use App\Models\TanggunganKeluargaModel;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        $this->call(PersonilSeeder::class);

        // ==== Personil Feature ====
        $this->call(SekretarisSeeder::class);


        // ==== end of Personil Feature ====
        
        PegawaiModel::create([
            "nama_pegawai" => "Darwati, S.E",
            "nip" => "19700105 199112 2 001",
            "jabatan" => "Akun/Silta/KA",
            'golongan' => 'Penata III/d'
        ]);
    }
}
