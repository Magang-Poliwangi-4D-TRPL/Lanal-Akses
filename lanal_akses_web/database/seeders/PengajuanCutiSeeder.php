<?php

namespace Database\Seeders;

use App\Models\PengajuanCutiModel;
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
        $pengajuan1 = new PengajuanCutiModel;
        $pengajuan1->create([
            'nomor_surat' => '02/163/10/2024',
            'personil_id' => 163,
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


        $respon1 = new ResponCutiModel;
        $respon1->create([
            'pengajuan_cuti_id' => 1,
            'atasan_id' => 7,
            'status_atasan' => 'Disetujui',
            'palaksa_id' => 2,
            'status_palaksa' => 'Disetujui',
            'sekretaris_id' => 190,
            'status_sekretaris' => 'Disetujui',
            'komandan_id' => 1,
            'status_komandan' => 'Disetujui',
        ]);

        $pengajuan2 = new PengajuanCutiModel;
        $pengajuan2->create([
            'nomor_surat' => '03/163/10/2024',
            'personil_id' => 163,
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

        $respon2 = new ResponCutiModel;
        $respon2->create([
            'pengajuan_cuti_id' => 2,
            'atasan_id' => 7,
            'status_atasan' => 'Ditolak',
            'palaksa_id' => 2,
            'status_palaksa' => 'Ditolak',
            'sekretaris_id' => 190,
            'status_sekretaris' => 'Ditolak',
            'komandan_id' => 1,
            'status_komandan' => 'Ditolak',
        ]);
    }
}
