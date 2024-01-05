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
        $personil = PersonilModel::create([
            "nama_lengkap" => "Suhendra Kurniawan",
            "pangkat" => "Letda Laut",
            "korps" => "(KH)",
            "nrp" => "26226/P",
            "jabatan" => "Simak/paur BMN",
            'jenis_kelamin' => 'L',
            'tempat_lahir' => 'BANGKALAN',
            'tanggal_lahir' => '20-12-1989',
        ]);

        $personil->save();
        $personil = PersonilModel::where('nrp', '26226/P')->first();
    
        PendidikanFormalModel::create([
            "nama_pendidikan" => "SDN 1 Bangkalan",
            "lama_pendidikan" => "6 tahun",
            "tahun_lulus" => "2001",
            "keterangan" => "ijasah",
            "personil_id" => $personil->id,
        ]);
    
        PendidikanMiliterModel::create([
            "nama_pendidikan" => "DIKMABA PK ANGK-30 TH.2010",
            "lama_pendidikan" => "6 bulan",
            "tahun_lulus" => "2010",
            "keterangan" => "ijasah",
            "personil_id" => $personil->id,
        ]);
    
        KursusModel::create([
            "nama_kursus" => "Kursus Microsoft Office",
            "tempat_kursus" => "LKPTCC Banyuwangi",
            "lama_kursus" => "4 bulan",
            "keterangan" => "sertifikat",
            "personil_id" => $personil->id,
        ]);
    
        TanggunganKeluargaModel::create([
            "nama_lengkap" => "Anak Suhendra Kurniawan",
            "tempat_tanggal_lahir" => "Banyuwangi, 1 Januari 2016",
            "status_hubungan" => "anak",
            "keterangan" => "-",
            "personil_id" => $personil->id,
        ]);
    
        PerlengkapanModel::create([
            'baju' => "S",
            'celana' => "S",
            'no_sepatu' => 43,
            'no_topi' => 36,
            'no_mut' => 38,
            'keterangan' => null,
            'personil_id' => $personil->id,
        ]);
    
        TandaJasaModel::create([
            'nama_tanda_jasa' => "SL XII",
            'no_skep' => "KED/-/-/-",
            'keterangan' => null,
            'personil_id' => $personil->id,
        ]);
    
        DataKepangkatanModel::create([
            'pangkat' => "LETDA",
            'no_skep' => "KED/-/-/-",
            'tempat_pangkat' => "Mako Lanal Banyuwangi",
            'keterangan' => null,
            'personil_id' => $personil->id,
        ]);
    
        RiwayatPenugasanModel::create([
            'tahun' => "2011-2022",
            'jabatan' => "PASET",
            'tempat' => "Mako Lanal Banyuwangi",
            'keterangan' => null,
            'personil_id' => $personil->id,
        ]);
    
        SanksiHukumanModel::create([
            'nama_hukuman' => "Hukuman 1",
            'tahun_hukuman' => "2023",
            'keterangan' => null,
            'personil_id' => $personil->id,
        ]);


        // ==== end of Personil Feature ====
        
        PegawaiModel::create([
            "nama_pegawai" => "Darwati, S.E",
            "nip" => "19700105 199112 2 001",
            "jabatan" => "Akun/Silta/KA",
            'golongan' => 'Penata III/d'
        ]);
    }
}
