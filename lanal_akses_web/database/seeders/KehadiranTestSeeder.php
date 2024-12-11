<?php

namespace Database\Seeders;

use App\Models\KehadiranModel;
use App\Models\WaktuKerjaModel;
use Illuminate\Database\Seeder;

class KehadiranTestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        WaktuKerjaModel::create([
            "nama_waktu_kerja" => 'Informasi jam kerja seluruh personil & pegawai LANAL BWI',
            "jam_masuk_mulai" => '07:00:00',
            "jam_masuk_selesai" => '23:59:00',
            "jam_pulang_mulai" => '13:00:00',
            "jam_pulang_selesai" => '23:59:00',
            "keterangan" => 'Setiap personil dan pegawai akan menggunakan format waktu jam kerja ini sebagai patokan presensi',
        ]);
        KehadiranModel::factory(10)->create();
    }
}
