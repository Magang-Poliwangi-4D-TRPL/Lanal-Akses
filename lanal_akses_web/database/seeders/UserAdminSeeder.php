<?php

namespace Database\Seeders;

use App\Models\PegawaiModel;
use App\Models\PersonilModel;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $personil = personilModel::all();
        foreach ($personil as $key => $value) 
        {
            $user = User::create([
                "nama_lengkap" => $value['nama_lengkap'],
                "username" => $value['nrp'],
                "password" => Hash::make($value['nrp']),
                'personil_id' => $value['id']
            ]);
            $user->assignRole('personel');
        }
        $pegawai = PegawaiModel::all();
        foreach ($pegawai as $key => $value) {
            $user = User::create([
                "nama_lengkap" => $value['nama_pegawai'],
                "username" => $value['nip'],
                "password" => Hash::make($value['nip']),
                'pegawai_id' => $value['id']
            ]);

            $user->assignRole('pegawai');
            
        }
        $paset = PersonilModel::where('nrp', '26226/P')->first();
        $paset_akun = User::where('personil_id', $paset->id)->first();
        $role_paset = Role::where('name', 'paset')->first();
        $paset_akun->removeRole('personel');
        $paset_akun->assignRole($role_paset);
    
        $komandan = PersonilModel::where('nrp', '16572/P')->first();
        $komandan_akun = User::where('personil_id', $komandan->id)->first();
        $role_komandan = Role::where('name', 'komandan')->first();
        $komandan_akun->removeRole('personel');
        $komandan_akun->assignRole($role_komandan);
    
        $palaksa = PersonilModel::where('nrp', '17374/P')->first();
        $palaksa_akun = User::where('personil_id', $palaksa->id)->first();
        $role_palaksa = Role::where('name', 'palaksa')->first();
        $palaksa_akun->removeRole('personel');
        $palaksa_akun->assignRole($role_palaksa);
    
        $paspotmar = PersonilModel::where('nrp', '21037/P')->first();
        $paspotmar_akun = User::where('personil_id', $paspotmar->id)->first();
        $role_paspotmar = Role::where('name', 'paspotmar')->first();
        $paspotmar_akun->removeRole('personel');
        $paspotmar_akun->assignRole($role_paspotmar);
    
    
    }
}
