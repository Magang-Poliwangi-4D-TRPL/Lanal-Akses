<?php

namespace Database\Seeders;

use App\Models\PersonilModel;
use Illuminate\Database\Seeder;

class PersonilSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(){
        PersonilModel::truncate();
        $url = 'public/datapersonil.json';
        $jsonFile = file_get_contents($url);
        $dataPersonil = json_decode($jsonFile, true);
        if ($dataPersonil==null) {
            print('kesalahan saat mengambil file');
        } else {
            foreach ($dataPersonil as $key => $value) {
                PersonilModel::create([
                    "nama_lengkap" => $value['nama_lengkap'],
                    "pangkat" => $value['pangkat'],
                    "korps" => $value['korps'],
                    "nrp" => $value['nrp'],
                    "jabatan" => $value['jabatan'],
                    'jenis_kelamin' => 'L'
    
                ]);
    
            }
        }

        
    }
}