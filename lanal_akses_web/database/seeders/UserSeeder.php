<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use App\Models\User;


use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::beginTransaction();
        try {
            $admin1 = User::create([
                'email' => 'admin1@gmail.com',
                'nama_lengkap' => 'Admin 1',
                'username' => 'admin1',
                'password' => bcrypt('admin123'),
            ]);
            
            // $role_admin = Role::create(['name' => 'admin']);
            // $role_personel = Role::create(['name' => 'personel']);
            // $role_pegawai = Role::create(['name' => 'pegawai']);
            // $role_komandan = Role::create(['name' => 'komandan']);
            // $role_paset = Role::create(['name' => 'paset']);
            // $role_pasmin = Role::create(['name' => 'pasmin']);
            // $role_kaakun = Role::create(['name' => 'kaakun']);
    
            // $manage_personel_permission = Permission::create(['name' =>'manage personel']);
            // $manage_pegawai_permission = Permission::create(['name' =>'manage pegawai']);
            // $read_personel_permission = Permission::create(['name' =>'read personel']);
            // $read_pegawai_permission = Permission::create(['name' =>'read pegawai']);
            // $can_access_all_permission = Permission::create(['name' =>'can access all']);
            
            // $admin1->assignRole('admin');
            
            // $role_admin->givePermissionTo($can_access_all_permission);

            // $role_komandan->givePermissionTo($read_personel_permission);
            // $role_komandan->givePermissionTo($manage_personel_permission);
            // $role_komandan->givePermissionTo($read_pegawai_permission);
            // $role_komandan->givePermissionTo($manage_pegawai_permission);
            
            // $role_paset->givePermissionTo($read_personel_permission);
            // $role_paset->givePermissionTo($manage_personel_permission);
            // $role_paset->givePermissionTo($read_pegawai_permission);
            // $role_paset->givePermissionTo($manage_pegawai_permission);
            
            // $role_pasmin->givePermissionTo($read_personel_permission);
            // $role_pasmin->givePermissionTo($manage_personel_permission);
            
            // $role_kaakun->givePermissionTo($read_pegawai_permission);
            // $role_kaakun->givePermissionTo($read_personel_permission);
            // $role_kaakun->givePermissionTo($manage_pegawai_permission);

            DB::commit();
        } catch (\Throwable $th) {
            //throw $th;
            DB::rollBack();
        }

    }
}
