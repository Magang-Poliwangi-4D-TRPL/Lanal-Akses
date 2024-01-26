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
use App\Models\WaktuKerjaModel;
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

        $this->call(SekretarisSeeder::class);

        $this->call(PegawaiSeeder::class);

        $this->call(UserSeeder::class);

        WaktuKerjaModel::create([
            "nama_waktu_kerja" => 'Informasi jam kerja seluruh personil & pegawai LANAL BWI',
            "jam_masuk_mulai" => '07:00:00',
            "jam_masuk_selesai" => '23:59:00',
            "jam_pulang_mulai" => '13:00:00',
            "jam_pulang_selesai" => '23:59:00',
            "keterangan" => 'Setiap personil dan pegawai akan menggunakan format waktu jam kerja ini sebagai patokan presensi',
        ]);
    }
}
