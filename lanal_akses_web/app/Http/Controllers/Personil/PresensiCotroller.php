<?php

namespace App\Http\Controllers\Personil;

use App\Http\Controllers\Controller;
use App\Models\KehadiranModel;
use DateTime;
use DateTimeZone;
use Illuminate\Http\Request;
use Carbon\Carbon;

class PresensiCotroller extends Controller
{

public function index()
{
    $utc_timezone = new DateTimeZone("UTC");
    $tallinn_timezone = new DateTimeZone("Asia/Jakarta");

    // Current date in UTC, converted to Jakarta time
    $datetime = new DateTime("now", $utc_timezone);
    $datetime->setTimezone($tallinn_timezone);
    $date = $datetime->format('Y-m-d');

    // Get personil data
    $personil = auth()->user()->personil;

    $startDate = Carbon::now()->subDays(5)->format('Y-m-d');
    $riwayat_presensi = KehadiranModel::where('personil_id', $personil->id)
    ->whereBetween('tanggal_kehadiran', [$startDate, $date])
    ->orderBy('tanggal_kehadiran', 'desc')
    ->get();
    $startDate = Carbon::now()->subDays(30)->format('Y-m-d');
    $riwayat_presensi_one_month = KehadiranModel::where('personil_id', $personil->id)
        ->whereBetween('tanggal_kehadiran', [$startDate, $date])
        ->orderBy('tanggal_kehadiran', 'desc')
        ->get();

    $statusKehadiranIcon = [
        'check',
        'xmark',
        'clock',
        'file',
        'circle-exclamation',
    ];
    $statusKehadiran = [
        'Hadir',
        'Tidak Hadir',
        'Terlambat',
        'Cuti',
        'Belum Absen',
    ];
    $bgStatusKehadiran = [
        'success',
        'danger',
        'warning',
        'primary',
        'secondary',
    ];
    $iconColor = [
        'text-success',
        'text-danger',
        'text-warning',
        'text-primary',
        'text-secondary',
    ];

    $presensi_hari_ini = KehadiranModel::where('tanggal_kehadiran', $date)->where('personil_id', $personil->id)->get()->first();

    // Count each status
    if (!$riwayat_presensi_one_month) {
        $personilStatusCounts = null;
    } else {
    
    
    $hadirCount = KehadiranModel::where('personil_id', $personil->id)
        ->where('status_kehadiran', 'Hadir')
        ->whereBetween('tanggal_kehadiran', [$startDate, $date])
        ->count();

    $tidakHadirCount = KehadiranModel::where('personil_id', $personil->id)
        ->where('status_kehadiran', 'Tidak Hadir')
        ->whereBetween('tanggal_kehadiran', [$startDate, $date])
        ->count();

    $terlambatCount = KehadiranModel::where('personil_id', $personil->id)
        ->where('status_kehadiran', 'Terlambat')
        ->whereBetween('tanggal_kehadiran', [$startDate, $date])
        ->count();

    $cutiCount = KehadiranModel::where('personil_id', $personil->id)
        ->whereNotIn('status_kehadiran', ['Hadir', 'Terlambat', 'Tidak Hadir', 'Belum Absen'])
        ->whereBetween('tanggal_kehadiran', [$startDate, $date])
        ->count();
        
        
        // Data untuk dikirim ke view
        $personilStatusCounts = [
            'Hadir' => $hadirCount,
            'Terlambat' => $terlambatCount,
            'Tidak Hadir' => $tidakHadirCount,
            'Cuti' => $cutiCount
        ];
    }    
    return view('personil.presensi.index', compact('riwayat_presensi', 'riwayat_presensi_one_month', 'personilStatusCounts', 'date', 'statusKehadiran', 'iconColor', 'bgStatusKehadiran', 'statusKehadiranIcon', 'presensi_hari_ini'));
}

}
