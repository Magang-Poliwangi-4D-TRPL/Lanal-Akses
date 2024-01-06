<?php

namespace Database\Seeders;

use App\Models\PegawaiModel;
use Illuminate\Database\Seeder;

class PegawaiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        PegawaiModel::truncate();
        $url = 'public/datapegawai.json';
        $jsonFile = file_get_contents($url);
        $dataPegawai = json_decode($jsonFile, true);
        if ($dataPegawai==null) {
            print('kesalahan saat mengambil file');
        } else {
            foreach ($dataPegawai as $key => $value) {
                PegawaiModel::create([
                    "nama_pegawai" => $value['nama_pegawai'],
                    "golongan" => $value['golongan'],
                    "nip" => $value['nip'],
                    "jabatan" => $value['jabatan'],
                    'jenis_kelamin' => $value['jenis_kelamin']
                ]);
    
            }
        }
    }
}
