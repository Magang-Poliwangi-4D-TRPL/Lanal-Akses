<?php

namespace Database\Seeders;

use App\Models\KehadiranModel;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class UpdateKehadiranHariIni extends Seeder
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
        $dataKehadiranToday = KehadiranModel::where('tanggal_kehadiran', $startDate)->get();

        // dd($dataKehadiranToday);
        foreach ($dataKehadiranToday as $kehadiran) {
             // Update the status_kehadiran for each record
             $kehadiran->status_kehadiran = 'Belum Absen';
             $kehadiran->save(); // Save the changes
        }
    }
}
