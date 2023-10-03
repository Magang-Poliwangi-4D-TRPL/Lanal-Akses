<?php

namespace Database\Seeders;

use App\Models\PersonilModel;
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
        PersonilModel::create([
            "nama_lengkap" => "Suhendra Kurniawan",
            "pangkat" => "Letda Laut",
            "korps" => "(KH)",
            "nrp" => "26226/P",
            "jabatan" => "Simak/paur BMN",
            'jenis_kelamin' => 'L'

        ]);

        User::create([
            "nama_lengkap" => "Komandan Lanal BWI",
            "username" => "komandanlanalbwi",
            "password" => Hash::make('komandan123'),
            "role" => "komandan",

        ]);
    }
}
