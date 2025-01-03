<?php

namespace Database\Seeders;

use App\Models\DataCutiPegawaiModel;
use App\Models\DataCutiPersonelModel;
use App\Models\PegawaiModel;
use App\Models\PengajuanCutiModel;
use App\Models\PersonilModel;
use App\Models\ResponCutiModel;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class PengajuanCutiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $personil1 = PersonilModel::find(163);
        $pengajuan1 = new PengajuanCutiModel;
        $pengajuan1->create([
            'nomor_surat' => '02/163/10/2023',
            'tanggal_mulai_cuti' => Carbon::now(),
            'tanggal_selesai_cuti' => Carbon::now()->addDays(1),
            'cuti_id' => 1,
            'status' => 'Disetujui Komandan',
            'alasan_cuti' => 'Cuti untuk mengambil istirahat',
            'no_telepon' => '+62123456789012',
            'alamat_cuti' => 'Jl. Gatot Subroto, Lkr. Kp. Baru, Bulusan, Kec. Kalipuro, Kabupaten Banyuwangi, Jawa Timur 68455, Indonesia',
            'atasan_id' => 7,
            'jenis_cuti' => 'tahunan',
            'keterangan' => '-',
        ]);
        $pengajuan1 = PengajuanCutiModel::find(1);
        $dataPengajuanCutiPersonil1 = DataCutiPersonelModel::create([
            "personil_id" => $personil1->id,
            "cuti_id" => 1,
            "pengajuan_cuti_id" => $pengajuan1->id,
            'tanggal_mulai' => $pengajuan1->tanggal_mulai_cuti,
            'tanggal_selesai' => $pengajuan1->tanggal_selesai_cuti,
            'jumlah_hari' => 2,
            'created_at' => Carbon::now()->subYear(), // Set created_at to one year ago
        ]);

        $respon1 = new ResponCutiModel;
        $respon1->create([
            'pengajuan_cuti_id' => $pengajuan1->id,
            'atasan_id' => 7,
            'status_atasan' => 'Disetujui',
            'palaksa_id' => 2,
            'status_palaksa' => 'Disetujui',
            'sekretaris_id' => 190,
            'status_sekretaris' => 'Disetujui',
            'komandan_id' => 1,
            'status_komandan' => 'Disetujui',
        ]);
        $personil1 = PersonilModel::find(163);
        $pengajuan1 = new PengajuanCutiModel;
        $pengajuan1->create([
            'nomor_surat' => '02/163/10/2024',
            // 'personil_id' => 163,
            'tanggal_mulai_cuti' => Carbon::now(),
            'tanggal_selesai_cuti' => Carbon::now()->addDays(1),
            'cuti_id' => 1,
            'status' => 'Disetujui Komandan',
            'alasan_cuti' => 'Cuti untuk mengambil istirahat',
            'no_telepon' => '+62123456789012',
            'alamat_cuti' => 'Jl. Gatot Subroto, Lkr. Kp. Baru, Bulusan, Kec. Kalipuro, Kabupaten Banyuwangi, Jawa Timur 68455, Indonesia',
            'atasan_id' => 7,
            'jenis_cuti' => 'tahunan',
            'keterangan' => '-',
        ]);
        $pengajuan1 = PengajuanCutiModel::find(2);
        $dataPengajuanCutiPersonil1 = DataCutiPersonelModel::create([
            "personil_id" => $personil1->id,
            "cuti_id" => 1,
            "pengajuan_cuti_id" => $pengajuan1->id,
            'tanggal_mulai' => $pengajuan1->tanggal_mulai_cuti,
            'tanggal_selesai' => $pengajuan1->tanggal_selesai_cuti,
            'jumlah_hari' => 2,
        ]);


        $respon1 = new ResponCutiModel;
        $respon1->create([
            'pengajuan_cuti_id' => $pengajuan1->id,
            'atasan_id' => 7,
            'status_atasan' => 'Disetujui',
            'palaksa_id' => 2,
            'status_palaksa' => 'Disetujui',
            'sekretaris_id' => 190,
            'status_sekretaris' => 'Disetujui',
            'komandan_id' => 1,
            'status_komandan' => 'Disetujui',
        ]);

        $pegawai1 = PegawaiModel::find(1);
        $pengajuan2 = new PengajuanCutiModel;
        $pengajuan2->create([
            'nomor_surat' => '03/163/10/2024',
            // 'personil_id' => 163,
            'tanggal_mulai_cuti' => Carbon::now(),
            'tanggal_selesai_cuti' => Carbon::now()->addDays(1),
            'cuti_id' => 1,
            'status' => 'Ditolak',
            'alasan_cuti' => 'Cuti untuk mengambil istirahat',
            'no_telepon' => '+62123456789012',
            'alamat_cuti' => 'Jl. Gatot Subroto, Lkr. Kp. Baru, Bulusan, Kec. Kalipuro, Kabupaten Banyuwangi, Jawa Timur 68455, Indonesia',
            'atasan_id' => 7,
            'jenis_cuti' => 'tahunan',
            'keterangan' => '-',
        ]);

        $pengajuan2 = PengajuanCutiModel::find(3);

        $dataPengajucanCutiPegawai = DataCutiPegawaiModel::create([
            "pegawai_id" => $pegawai1->id,
            "cuti_id" => 1,
            "pengajuan_cuti_id" => $pengajuan2->id,
            'tanggal_mulai' => $pengajuan2->tanggal_mulai_cuti,
            'tanggal_selesai' => $pengajuan2->tanggal_selesai_cuti,
            'jumlah_hari' => 2,
        ]);

        $respon2 = new ResponCutiModel;
        $respon2->create([
            'pengajuan_cuti_id' => $pengajuan2->id,
            'atasan_id' => 7,
            'status_atasan' => 'Disetujui',
            'palaksa_id' => 2,
            'status_palaksa' => 'Disetujui',
            'sekretaris_id' => 190,
            'status_sekretaris' => 'Disetujui',
            'komandan_id' => 1,
            'status_komandan' => 'Ditolak',
        ]);
    }
}
