<?php

namespace Database\Seeders;

use App\Models\KehadiranModel;
use App\Models\PegawaiModel;
use App\Models\PersonilModel;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class KehadiranOneMonthSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        // Get today's date
        $startDate = Carbon::today();

        // Get all personnel from the PersonilModel
        $personnels = PersonilModel::all();
        $pegawais = PegawaiModel::all();
        $status_kehadiran = [
            'Hadir',
            'Hadir',
            'Hadir',
            'Hadir',
            'Tidak Hadir',
            'Terlambat',
            'Cuti Sakit',
            'Cuti Tahunan',
        ];

        // Loop through each pegawai
        foreach ($pegawais as $pegawai) {
            // Generate attendance records for one month (-30 days)
            for ($i = 0; $i > -30; $i--) {
                // Calculate the date
                $date = $startDate->copy()->addDays($i);

                // Create a new attendance record
                KehadiranModel::create([
                    'pegawai_id' => $pegawai->id,
                    'tanggal_kehadiran' => $date,
                    'status_kehadiran' => $status_kehadiran[rand(0, 7)], // Default status
                    'jam_masuk' => null,
                    'jam_pulang' => null,
                    'keterangan' => null,
                    'lokasi' => null,
                    'waktu_kerja_id' => 1, // Add appropriate waktu_kerja_id if needed
                ]);
            }
        }
        // Loop through each personnel
        foreach ($personnels as $personnel) {
            // Generate attendance records for one month (7 days)
            for ($i = 0; $i > -30; $i--) {
                // Calculate the date
                $date = $startDate->copy()->addDays($i);

                // Create a new attendance record
                KehadiranModel::create([
                    'personil_id' => $personnel->id,
                    'tanggal_kehadiran' => $date,
                    'status_kehadiran' => $status_kehadiran[rand(0, 7)], // Default status
                    'jam_masuk' => null,
                    'jam_pulang' => null,
                    'keterangan' => null,
                    'lokasi' => null,
                    'waktu_kerja_id' => 1, // Add appropriate waktu_kerja_id if needed
                ]);
            }
        }
        // Loop through each pegawai
        foreach ($pegawais as $pegawai) {
            // Generate attendance records for one month (7 days)
            for ($i = 1; $i <= 7; $i++) {
                // Calculate the date
                $date = $startDate->copy()->addDays($i);

                // Create a new attendance record
                KehadiranModel::create([
                    'pegawai_id' => $pegawai->id,
                    'tanggal_kehadiran' => $date,
                    'status_kehadiran' =>'Belum Absen', // Default status
                    'jam_masuk' => null,
                    'jam_pulang' => null,
                    'keterangan' => null,
                    'lokasi' => null,
                    'waktu_kerja_id' => 1, // Add appropriate waktu_kerja_id if needed
                ]);
            }
        }
        // Loop through each personnel
        foreach ($personnels as $personnel) {
            // Generate attendance records for one month (-30 days)
            for ($i = 1; $i <= 7; $i++) {
                // Calculate the date
                $date = $startDate->copy()->addDays($i);

                // Create a new attendance record
                KehadiranModel::create([
                    'personil_id' => $personnel->id,
                    'tanggal_kehadiran' => $date,
                    'status_kehadiran' => "Belum Absen", // Default status
                    'jam_masuk' => null,
                    'jam_pulang' => null,
                    'keterangan' => null,
                    'lokasi' => null,
                    'waktu_kerja_id' => 1, // Add appropriate waktu_kerja_id if needed
                ]);
            }
        }
    }
}
