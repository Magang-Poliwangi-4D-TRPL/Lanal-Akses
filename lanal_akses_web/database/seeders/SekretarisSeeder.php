<?php

namespace Database\Seeders;

use App\Models\DataKepangkatanModel;
use App\Models\KursusModel;
use App\Models\PendidikanFormalModel;
use App\Models\PendidikanMiliterModel;
use App\Models\PerlengkapanModel;
use App\Models\PersonilModel;
use App\Models\RiwayatPenugasanModel;
use App\Models\SanksiHukumanModel;
use App\Models\TandaJasaModel;
use App\Models\TanggunganKeluargaModel;
use Illuminate\Database\Seeder;

class SekretarisSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $personil = PersonilModel::create([
            "nama_lengkap" => "Suhendra Kurniawan",
            "pangkat" => "Letda",
            "korps" => "KH",
            "nrp" => "26226/P",
            "jabatan" => "KOARMADA II/LANTAMAL V SBY/LANAL BANYUWANGI/SMINLOG/UR BMN/PA",
            'jenis_kelamin' => 'L',
            'tempat_lahir' => 'BANGKALAN',
            'tanggal_lahir' => '20-12-1989',
            'agama' => 'Islam',
            'suku_bangsa' => 'Madura',
            'alamat_sekarang' => 'PERUM TNI AL B VII/3 RT 019 RW 007 KEL KEDUNGKENDO KEC CANDI SIDOARJO, JAWA
            TIMUR',
            'image_url' => 'storage/images/1704467254.jpg',
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
        PendidikanFormalModel::create([
            "nama_pendidikan" => "SMPN 1 Bangkalan",
            "lama_pendidikan" => "3 tahun",
            "tahun_lulus" => "2004",
            "keterangan" => "ijasah",
            "personil_id" => $personil->id,
        ]);
        PendidikanFormalModel::create([
            "nama_pendidikan" => "SMAN 1 Bangkalan",
            "lama_pendidikan" => "3 tahun",
            "tahun_lulus" => "2007",
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
        PendidikanMiliterModel::create([
            "nama_pendidikan" => "DIKTUKPA ANGK LII TA 2022",
            "lama_pendidikan" => "6 bulan",
            "tahun_lulus" => "2022",
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
            'nama_tanda_jasa' => "SL. KESETIAAN VIII",
            'no_skep' => "KED/-/-/-",
            'keterangan' => null,
            'personil_id' => $personil->id,
        ]);
        TandaJasaModel::create([
            'nama_tanda_jasa' => "SL. WIRA NUSA",
            'no_skep' => "KED/-/-/-",
            'keterangan' => null,
            'personil_id' => $personil->id,
        ]);
        TandaJasaModel::create([
            'nama_tanda_jasa' => "SL. DHARMA NUSA",
            'no_skep' => "KED/-/-/-",
            'keterangan' => null,
            'personil_id' => $personil->id,
        ]);
    
        DataKepangkatanModel::create([
            'pangkat' => "SERDA",
            'no_skep' => "KED/-/-/-",
            'tempat_pangkat' => "Mako Lanal Banyuwangi",
            'keterangan' => null,
            'personil_id' => $personil->id,
        ]);
        DataKepangkatanModel::create([
            'pangkat' => "SERTU",
            'no_skep' => "KED/-/-/-",
            'tempat_pangkat' => "Mako Lanal Banyuwangi",
            'keterangan' => null,
            'personil_id' => $personil->id,
        ]);
        DataKepangkatanModel::create([
            'pangkat' => "SERKA",
            'no_skep' => "KED/-/-/-",
            'tempat_pangkat' => "Mako Lanal Banyuwangi",
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
            'tahun' => "2011",
            'jabatan' => "KOARMATIM/LANTAMAL X JPR/LANAL BIAK/ANGGOTA",
            'tempat' => "LANAL BIAK",
            'keterangan' => null,
            'personil_id' => $personil->id,
        ]);
        RiwayatPenugasanModel::create([
            'tahun' => "2014",
            'jabatan' => "KOARMATIM/LANTAMAL X JPR/LANAL BIAK/SMINLOG/UR BMN/UR BARANG
            BERGERAK",
            'tempat' => "LANAL BIAK",
            'keterangan' => null,
            'personil_id' => $personil->id,
        ]);
        RiwayatPenugasanModel::create([
            'tahun' => "2018",
            'jabatan' => "KOARMADA III/LANTAMAL X JPR/LANAL BIAK/SMINLOG/UR BMN/UR
            BARANG BERGERAK",
            'tempat' => "LANAL BIAK",
            'keterangan' => null,
            'personil_id' => $personil->id,
        ]);
        RiwayatPenugasanModel::create([
            'tahun' => "2014",
            'jabatan' => "KOARMADA III/LANTAMAL X JPR/LANAL BIAK/SATMA/BA (DIKTUKPA ANGK
            LII TA 2022)",
            'tempat' => "LANAL BIAK",
            'keterangan' => null,
            'personil_id' => $personil->id,
        ]);
        RiwayatPenugasanModel::create([
            'tahun' => "2014",
            'jabatan' => "KOARMADA II/LANTAMAL V SBY/LANAL BANYUWANGI/SMINLOG/UR
            BMN/PA",
            'tempat' => "LANAL BANYUWANGI",
            'keterangan' => null,
            'personil_id' => $personil->id,
        ]);
    
        SanksiHukumanModel::create([
            'nama_hukuman' => "Hukuman 1",
            'tahun_hukuman' => "2023",
            'keterangan' => null,
            'personil_id' => $personil->id,
        ]);



    }
}
