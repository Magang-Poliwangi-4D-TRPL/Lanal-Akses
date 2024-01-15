<?php

namespace App\Http\Controllers;

use App\Models\KehadiranModel;
use App\Models\PersonilModel;
use App\Models\WaktuKerjaModel;
use Carbon\Carbon;
use DateTime;
use DateTimeZone;
use Illuminate\Http\Request;

class PublicController extends Controller
{
    public function absensiPersonil(){
        $utc_timezone = new DateTimeZone("UTC");

        $tallinn_timezone = new DateTimeZone("Asia/Jakarta");

        // Create a new DateTime object in the UTC format

        $datetime = new DateTime("now", $utc_timezone);

        // Convert the DateTime object to the timezone of Tallinn
        $datetime->setTimezone($tallinn_timezone);
        $date = $datetime->format('Y-m-d');
        
        $waktu_kerja = WaktuKerjaModel::all();
        if ($waktu_kerja->count()<=0) {
            return abort('404', 'waktu kerja belum dibuat, coba lagi nanti');
        } else {
            # code...
            return view('absensi', compact('date', 'waktu_kerja'));
        }
        

    }

    public function absensiPersonilStore(Request $request) {
        // dd($request);
        $validateData = $request->validate([
            "nama_lengkap" => "required|string|max:255",
            "nrp" => "required|string|max:255|exists:personil,nrp",
            "status_kehadiran" => "required|string",
            "keterangan" => "nullable|string|max:255",
            "lokasi" => "required",
        ],[
            "nama_lengkap.required" => 'Harap masukkan nama lengkap anda',
            "nrp.required" => 'Harap masukkan nama lengkap anda',
            "lokasi.required" => 'Harap aktifkan fitur lokasi di perangkat anda',
            "nrp.exists" => 'NRP tidak ditemukan! Harap periksa kembali.',
        ],);
        
        $personil = PersonilModel::where('nrp', $validateData['nrp'])->get()->first();
        if ($personil == null) {
            return abort('404', 'Personel yang anda cari tidak dapat ditemukan');
        }
        $waktu_kerja = WaktuKerjaModel::find($request->waktu_kerja_id)->get()->first();
        $presensiPersonil = KehadiranModel::where('tanggal_kehadiran', $request->tanggal_absensi)->where('personil_id', $personil->id)->first();
        // dd($request);
        // dd($presensiPersonil);
        if ($presensiPersonil == null) {
            return abort('404', 'Maaf data absensi hari ini belum dibuat, tunggu admin membuat data absensi hari ini');
        } elseif ($presensiPersonil->status_kehadiran == 'Ijin' ) {
           return redirect()->route('absensi.success')->with('success', 'Anda telah melakukan absensi hari ini! Selamat menikmati hari.');
        }
        $utc_timezone = new DateTimeZone("UTC");

        $tallinn_timezone = new DateTimeZone("Asia/Jakarta");

        // Create a new DateTime object in the UTC format

        $datetime = new DateTime("now", $utc_timezone);

        // Convert the DateTime object to the timezone of Tallinn
        $datetime->setTimezone($tallinn_timezone);

        $current_time = $datetime->format('H:i:s');
        // dd($validateData['status_kehadiran'] == 'Ijin');
        if ($validateData['status_kehadiran'] == 'Ijin') {
            $presensiPersonil->update([
                'status_kehadiran' => $validateData['status_kehadiran'],
                'jam_masuk' => $current_time,
                'jam_pulang' => $current_time,
                'keterangan' => $validateData['keterangan'],
                'lokasi' => $validateData['lokasi'],
                'waktu_kerja_id' => $waktu_kerja->id,
            ]);

            return redirect()->route('absensi.success')->with('success', 'Terimakasih telah melakukan absensi, semoga anda dapat hadir di hari esok!');
        } else {
            if ($presensiPersonil->status_kehadiran == 'Belum Absen' && $presensiPersonil->jam_masuk == null) {
                if ($current_time > $waktu_kerja->jam_masuk_mulai) {
                    $validateData['status_kehadiran'] = 'Terlambat';
                    $validateData['jam_masuk'] = $current_time;

                    $presensiPersonil->update([
                        'status_kehadiran' => $validateData['status_kehadiran'],
                        'jam_masuk' => $validateData['jam_masuk'],
                        'jam_pulang' => null,
                        'keterangan' => $validateData['keterangan'],
                        'lokasi' => $validateData['lokasi'],
                        'waktu_kerja_id' => $waktu_kerja->id,
                    ]);

                    return redirect()->route('absensi.masuk.success')->with('warning', 'Anda berhasil melakukan absensi masuk hari ini. Jangan sampai terlambat lagi');
                } else {
                    $validateData['jam_masuk'] = $current_time;

                    $presensiPersonil->update([
                        'status_kehadiran' => $validateData['status_kehadiran'],
                        'jam_masuk' => $validateData['jam_masuk'],
                        'jam_pulang' => null,
                        'keterangan' => $validateData['keterangan'],
                        'lokasi' => $validateData['lokasi'],
                        'waktu_kerja_id' => $waktu_kerja->id,
                    ]);

                    return redirect()->route('absensi.masuk.success')->with('success', 'Anda berhasil melakukan absensi masuk hari ini. Jangan lupa untuk melakukan absensi pulang nanti');
                }
                
            } elseif ($presensiPersonil->jam_masuk != null) {
                if ($current_time < $waktu_kerja->jam_pulang_mulai) {
                    return redirect()->route('absensi.masuk.success')->with('warning', 'Anda telah melakukan absensi masuk, tunggu hingga waktu absensi pulang!');
                } else {
                    $validateData['jam_pulang'] = $current_time;
                    $presensiPersonil->update([
                        'jam_pulang' => $validateData['jam_pulang'],
                        'lokasi' => $validateData['lokasi'],
                    ]);

                    return redirect()->route('absensi.success')->with('success', 'Terimakasih telah melakukan absensi, semoga anda dapat hadir di hari esok!');
                }
            }
        }
    }

    public function absensiSuccess()
    {
        return view('response.success-absensi');
    }

    public function absensiMasukSuccess()
    {
        return view('response.success-absensi-masuk');
    }
}
