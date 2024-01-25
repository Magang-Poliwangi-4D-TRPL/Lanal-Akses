<?php

namespace App\Jobs;

use App\Models\KehadiranModel;
use App\Models\PegawaiModel;
use App\Models\PersonilModel;
use DateTime;
use DateTimeZone;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class AutoFillDailyAttendance implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        // Ambil semua karyawan
        $personil = PersonilModel::all();
        $pegawai = PegawaiModel::all();
        // Ambil tanggal hari ini
        $utc_timezone = new DateTimeZone("UTC");
        
        $tallinn_timezone = new DateTimeZone("Asia/Jakarta");
        
        // Create a new DateTime object in the UTC format
        
        $datetime = new DateTime("now", $utc_timezone);
        
        // Convert the DateTime object to the timezone of Tallinn
        $datetime->setTimezone($tallinn_timezone);
        $today = $datetime->format('Y-m-d');

        foreach ($personil as $employee) {
            // Periksa apakah presensi untuk karyawan pada tanggal hari ini sudah ada
            $existingAttendance = KehadiranModel::where('personil_id', $employee->id)
                ->whereDate('tanggal_kehadiran', $today)
                ->first();

            // Jika belum ada, buat presensi baru dengan status 'tidak hadir'
            if (!$existingAttendance) {
                KehadiranModel::create([
                    'personil_id' => $employee->id,
                    'tanggal_kehadiran' => $today,
                    'status_kehadiran' => 'Belum Absen',
                ]);
            }
        }
        foreach ($pegawai as $employee) {
            // Periksa apakah presensi untuk karyawan pada tanggal hari ini sudah ada
            $existingAttendance = KehadiranModel::where('pegawai_id', $employee->id)
                ->whereDate('tanggal_kehadiran', $today)
                ->first();

            // Jika belum ada, buat presensi baru dengan status 'tidak hadir'
            if (!$existingAttendance) {
                KehadiranModel::create([
                    'pegawai_id' => $employee->id,
                    'tanggal_kehadiran' => $today,
                    'status_kehadiran' => 'Belum Absen',
                ]);
            }
        }
    }
}
