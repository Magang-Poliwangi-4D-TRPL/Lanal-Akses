<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\WaktuKerjaModel;
use DateTime;
use DateTimeZone;
use Illuminate\Http\Request;

class AbsensiController extends Controller
{
    public function index()
    {
        $informasiJamKerja = WaktuKerjaModel::all();
        $absensiPersonil = array(
            [
                "nama_lengkap" => "Suhendra Kurniawan",
                "nrp" => "26266/P",
                "tanggal_absensi" => "08-01-2024",
                "jam_masuk" => "07:00:00",
                "jam_pulang" => "16:00:00",
                "status_kehadiran" => "hadir",
            ],
            [
                "nama_lengkap" => "Indra Nusha R",
                "nrp" => "16572/P",
                "tanggal_absensi" => "08-01-2024",
                "jam_masuk" => "07:00:00",
                "jam_pulang" => "16:00:00",
                "status_kehadiran" => "belum absen",
            ],
            [
                "nama_lengkap" => "Rochmat Abdullah",
                "nrp" => "17374/P",
                "tanggal_absensi" => "08-01-2024",
                "jam_masuk" => "07:00:00",
                "jam_pulang" => "16:00:00",
                "status_kehadiran" => "ijin",
            ],
            [
                "nama_lengkap" => "Rianto, S.H",
                "nrp" => "21037/P",
                "tanggal_absensi" => "08-01-2024",
                "jam_masuk" => "07:00:00",
                "jam_pulang" => "16:00:00",
                "status_kehadiran" => "terlambat",
            ],
            [
                "nama_lengkap" => "Eko Meiyanto",
                "nrp" => "21574/P",
                "tanggal_absensi" => "08-01-2024",
                "jam_masuk" => "07:00:00",
                "jam_pulang" => "16:00:00",
                "status_kehadiran" => "tidak hadir",
            ],
        );

        $absensiPegawai = array(
            [
                "nama_pegawai" => "Darwati, S.E",
                "nip" => "19700105 199112 2 001",
                "tanggal_absensi" => "08-01-2024",
                "jam_masuk" => "07:00:00",
                "jam_pulang" => "16:00:00",
                "status_kehadiran" => "hadir",
            ],
            [
                "nama_pegawai" => "Darwati, S.E",
                "nip" => "19700105 199112 2 001",
                "tanggal_absensi" => "08-01-2024",
                "jam_masuk" => "07:00:00",
                "jam_pulang" => "16:00:00",
                "status_kehadiran" => "belum absen",
            ],
            [
                "nama_pegawai" => "Suhartono",
                "nip" => "19681021 199303 1 001",
                "tanggal_absensi" => "08-01-2024",
                "jam_masuk" => "07:00:00",
                "jam_pulang" => "16:00:00",
                "status_kehadiran" => "ijin",
            ],
            [
                "nama_pegawai" => "Niluh Sumiani",
                "nip" => "19700428 199203 2 002",
                "tanggal_absensi" => "08-01-2024",
                "jam_masuk" => "07:00:00",
                "jam_pulang" => "16:00:00",
                "status_kehadiran" => "terlambat",
            ],
            [
                "nama_pegawai" => "Niluh Sumiani",
                "nip" => "19700428 199203 2 002",
                "tanggal_absensi" => "08-01-2024",
                "jam_masuk" => "07:00:00",
                "jam_pulang" => "16:00:00",
                "status_kehadiran" => "tidak hadir",
            ]
        );

        $utc_timezone = new DateTimeZone("UTC");

        $tallinn_timezone = new DateTimeZone("Asia/Jakarta");

        // Create a new DateTime object in the UTC format

        $datetime = new DateTime("now", $utc_timezone);

        // Convert the DateTime object to the timezone of Tallinn
        $datetime->setTimezone($tallinn_timezone);
        $date = $datetime->format('d/m/Y');
        
        
        $statusKehadiranIcon = [
            'check',
            'xmark',
            'clock',
            'file',
            'circle-exclamation',
        ];
        $statusKehadiran = [
            'hadir',
            'tidak hadir',
            'terlambat',
            'ijin',
            'belum absen',
        ];
        $bgStatusKehadiran = [
            'border-success',
            'border-danger',
            'border-warning',
            'border-primary',
            'border-secondary',
        ];
        $iconColor = [
            'text-success',
            'text-danger',
            'text-warning',
            'text-primary',
            'text-secondary',
        ];

        return view('admin.absensi.index', compact('absensiPersonil', 'absensiPegawai', 'date', 'statusKehadiranIcon', 'bgStatusKehadiran', 'iconColor', 'statusKehadiran', 'informasiJamKerja'));
    }

    public function show() {
        
        $statusKehadiranIcon = [
            'check',
            'xmark',
            'clock',
            'file',
            'circle-exclamation',
        ];
        $statusKehadiran = [
            'hadir',
            'tidak hadir',
            'terlambat',
            'ijin',
            'belum absen',
        ];
        $bgStatusKehadiran = [
            'border-success',
            'border-danger',
            'border-warning',
            'border-primary',
            'border-secondary',
        ];
        $iconColor = [
            'text-success',
            'text-danger',
            'text-warning',
            'text-primary',
            'text-secondary',
        ];

        $riwayatAbsensiPersonil = array(
            [
                "nama_lengkap" => "Suhendra Kurniawan",
                "keterangan" => "-",
                "tanggal_absensi" => "01-01-2024",
                "jam_masuk" => "07:00:00",
                "jam_pulang" => "16:00:00",
                "status_kehadiran" => "hadir",
            ],
            [
                "nama_lengkap" => "Suhendra Kurniawan",
                "keterangan" => "-",
                "tanggal_absensi" => "02-01-2024",
                "jam_masuk" => "07:00:00",
                "jam_pulang" => "16:00:00",
                "status_kehadiran" => "hadir",
            ],
            [
                "nama_lengkap" => "Suhendra Kurniawan",
                "keterangan" => "-",
                "tanggal_absensi" => "03-01-2024",
                "jam_masuk" => "07:00:00",
                "jam_pulang" => "16:00:00",
                "status_kehadiran" => "hadir",
            ],
            [
                "nama_lengkap" => "Suhendra Kurniawan",
                "keterangan" => "-",
                "tanggal_absensi" => "04-01-2024",
                "jam_masuk" => "07:00:00",
                "jam_pulang" => "16:00:00",
                "status_kehadiran" => "hadir",
            ],
            [
                "nama_lengkap" => "Suhendra Kurniawan",
                "keterangan" => "-",
                "tanggal_absensi" => "05-01-2024",
                "jam_masuk" => "07:00:00",
                "jam_pulang" => "16:00:00",
                "status_kehadiran" => "hadir",
            ],
            [
                "nama_lengkap" => "Suhendra Kurniawan",
                "keterangan" => "-",
                "tanggal_absensi" => "06-01-2024",
                "jam_masuk" => "07:00:00",
                "jam_pulang" => "16:00:00",
                "status_kehadiran" => "hadir",
            ],
        );
        return view('admin.absensi.show', compact('riwayatAbsensiPersonil', 'statusKehadiranIcon', 'bgStatusKehadiran', 'iconColor', 'statusKehadiran'));
    }

    public function filterAbsensi(){
        return view('admin.absensi.filter');
    }

    public function indexFilterAbsensi(){
        $absensiPersonil = array(
            [
                "nama_lengkap" => "Suhendra Kurniawan",
                "nrp" => "26266/P",
                "tanggal_absensi" => "08-01-2024",
                "jam_masuk" => "07:00:00",
                "jam_pulang" => "16:00:00",
                "status_kehadiran" => "hadir",
            ],
            [
                "nama_lengkap" => "Indra Nusha R",
                "nrp" => "16572/P",
                "tanggal_absensi" => "08-01-2024",
                "jam_masuk" => "07:00:00",
                "jam_pulang" => "16:00:00",
                "status_kehadiran" => "belum absen",
            ],
            [
                "nama_lengkap" => "Rochmat Abdullah",
                "nrp" => "17374/P",
                "tanggal_absensi" => "08-01-2024",
                "jam_masuk" => "07:00:00",
                "jam_pulang" => "16:00:00",
                "status_kehadiran" => "ijin",
            ],
            [
                "nama_lengkap" => "Rianto, S.H",
                "nrp" => "21037/P",
                "tanggal_absensi" => "08-01-2024",
                "jam_masuk" => "07:00:00",
                "jam_pulang" => "16:00:00",
                "status_kehadiran" => "terlambat",
            ],
            [
                "nama_lengkap" => "Eko Meiyanto",
                "nrp" => "21574/P",
                "tanggal_absensi" => "08-01-2024",
                "jam_masuk" => "07:00:00",
                "jam_pulang" => "16:00:00",
                "status_kehadiran" => "tidak hadir",
            ],
        );

        $absensiPegawai = array(
            [
                "nama_pegawai" => "Darwati, S.E",
                "nip" => "19700105 199112 2 001",
                "tanggal_absensi" => "08-01-2024",
                "jam_masuk" => "07:00:00",
                "jam_pulang" => "16:00:00",
                "status_kehadiran" => "hadir",
            ],
            [
                "nama_pegawai" => "Darwati, S.E",
                "nip" => "19700105 199112 2 001",
                "tanggal_absensi" => "08-01-2024",
                "jam_masuk" => "07:00:00",
                "jam_pulang" => "16:00:00",
                "status_kehadiran" => "belum absen",
            ],
            [
                "nama_pegawai" => "Suhartono",
                "nip" => "19681021 199303 1 001",
                "tanggal_absensi" => "08-01-2024",
                "jam_masuk" => "07:00:00",
                "jam_pulang" => "16:00:00",
                "status_kehadiran" => "ijin",
            ],
            [
                "nama_pegawai" => "Niluh Sumiani",
                "nip" => "19700428 199203 2 002",
                "tanggal_absensi" => "08-01-2024",
                "jam_masuk" => "07:00:00",
                "jam_pulang" => "16:00:00",
                "status_kehadiran" => "terlambat",
            ],
            [
                "nama_pegawai" => "Niluh Sumiani",
                "nip" => "19700428 199203 2 002",
                "tanggal_absensi" => "08-01-2024",
                "jam_masuk" => "07:00:00",
                "jam_pulang" => "16:00:00",
                "status_kehadiran" => "tidak hadir",
            ]
        );
        
        
        $statusKehadiranIcon = [
            'check',
            'xmark',
            'clock',
            'file',
            'circle-exclamation',
        ];
        $statusKehadiran = [
            'hadir',
            'tidak hadir',
            'terlambat',
            'ijin',
            'belum absen',
        ];
        $bgStatusKehadiran = [
            'border-success',
            'border-danger',
            'border-warning',
            'border-primary',
            'border-secondary',
        ];
        $iconColor = [
            'text-success',
            'text-danger',
            'text-warning',
            'text-primary',
            'text-secondary',
        ];


        $utc_timezone = new DateTimeZone("UTC");

        $tallinn_timezone = new DateTimeZone("Asia/Jakarta");

        // Create a new DateTime object in the UTC format

        $datetime = new DateTime("now", $utc_timezone);

        // Convert the DateTime object to the timezone of Tallinn
        $datetime->setTimezone($tallinn_timezone);
        $date = $datetime->format('d/m/Y');

        return view('admin.absensi.indexFilter', compact('absensiPersonil', 'absensiPegawai', 'date', 'statusKehadiranIcon', 'bgStatusKehadiran', 'iconColor', 'statusKehadiran'));
    }

    public function cetakPresensiHarian(){
        
    }

    public function cetakPresensiMingguan(){
        
    }

    public function cetakPresensiBulanan($int_month, $year){
        $arr_bulan = [
            1 => 'Januari',
            2 => 'Februari',
            3 => 'Maret',
            4 => 'April',
            5 => 'Mei',
            6 => 'Juni',
            7 => 'Juli',
            8 => 'Agustus',
            9 => 'September',
            10 => 'Oktober',
            11 => 'November',
            12 => 'Desember'
        ];

        $month = $arr_bulan[(int)$int_month];

        return view('admin.absensi.cetak.cetak-presensi-bulanan', compact('month', 'year'));
    }
}
