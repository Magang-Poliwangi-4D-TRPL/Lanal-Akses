<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\KehadiranModel;
use App\Models\PegawaiModel;
use App\Models\PersonilModel;
use App\Models\WaktuKerjaModel;
use Carbon\Carbon;
use DateInterval;
use DateTime;
use DateTimeZone;
use Illuminate\Http\Request;

class AbsensiController extends Controller
{
    public function index()
    {
        $informasiJamKerja = WaktuKerjaModel::all();
        
        $utc_timezone = new DateTimeZone("UTC");
        
        $tallinn_timezone = new DateTimeZone("Asia/Jakarta");
        
        // Create a new DateTime object in the UTC format
        
        $datetime = new DateTime("now", $utc_timezone);
        
        // Convert the DateTime object to the timezone of Tallinn
        $datetime->setTimezone($tallinn_timezone);
        $date = $datetime->format('Y-m-d');
        
        $absensiPersonil = KehadiranModel::where('tanggal_kehadiran', $date)->where('pegawai_id', null)->get();
        $absensiPegawai = KehadiranModel::where('tanggal_kehadiran', $date)->where('personil_id', null)->get();

        $countPresensiPersonilToday = KehadiranModel::where('tanggal_kehadiran', $date)->where('pegawai_id', null)->where('status_kehadiran', 'Belum Absen')->get();
        $countPresensiPegawaiToday = KehadiranModel::where('tanggal_kehadiran', $date)->where('personil_id', null)->where('status_kehadiran', 'Belum Absen')->get();
        // dd($absensiPersonil);
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
            'Ijin',
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

        return view('admin.absensi.index', compact('absensiPersonil', 'absensiPegawai', 'date', 'statusKehadiranIcon', 'bgStatusKehadiran', 'iconColor', 'statusKehadiran', 'informasiJamKerja', 'countPresensiPersonilToday', 'countPresensiPegawaiToday'));
    }

    public function show($tanggal_kehadiran, $idAnggota, $status_anggota) {
        
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
            'Ijin',
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

        if ($status_anggota == 'personel') {
            $detailPresensiAnggota = KehadiranModel::where('tanggal_kehadiran', $tanggal_kehadiran)->where('personil_id', $idAnggota)->first();
            $riwayatPresensiAnggota = KehadiranModel::where('personil_id', $idAnggota)->get();
        } else {
            $detailPresensiAnggota = KehadiranModel::where('tanggal_kehadiran', $tanggal_kehadiran)->where('pegawai_id', $idAnggota)->first();
            $riwayatPresensiAnggota = KehadiranModel::where('pegawai_id', $idAnggota)->get();
        }
        return view('admin.absensi.show', compact('detailPresensiAnggota', 'riwayatPresensiAnggota', 'statusKehadiranIcon', 'bgStatusKehadiran', 'iconColor', 'statusKehadiran'));
    }

    public function edit($idKehadiran)
    {
        $detailPresensiAnggota = KehadiranModel::find($idKehadiran);
        if ($detailPresensiAnggota == null) {
            return abort('404', 'Data detail presensi anggota tidak ditemukan');
        } else {
            
            return view('admin.absensi.edit', compact('detailPresensiAnggota'));
        }
    }

    public function update(Request $request, $idKehadiran)
    {
        $validatedData = $request->validate([
            'jam_masuk' => 'required|',
            'jam_pulang' => 'nullable|',
            'status_kehadiran' => 'required',
            'lokasi' => 'required',
            'keterangan' => 'nullable|max:255',
        ], [
            'jam_masuk.required' => 'Jam masuk harus diisi.',
            'lokasi.required' => 'Lokasi harus diisi.',
            'status_kehadiran.required' => 'Status kehadiran harus diisi.',
            'keterangan.max' => 'Keterangan tidak boleh melebih 255 karakter.'
        ]);

        $waktukerja = WaktuKerjaModel::first();
        $detailPresensiAnggota = KehadiranModel::find($idKehadiran);
        if ($detailPresensiAnggota == null) {
            return abort('404', 'Data detail presensi anggota tidak ditemukan');
        }
        
        if($validatedData['status_kehadiran'] == 'Hadir'){
            if ($validatedData['jam_masuk'] > $waktukerja->jam_masuk_mulai) {
                $validatedData['status_kehadiran'] = 'Terlambat';
            } 
        }
        if ($detailPresensiAnggota->personil_id == null) {
            $idAnggota = $detailPresensiAnggota->pegawai_id;
            $status_anggota = 'pegawai';
        } else {
            $idAnggota = $detailPresensiAnggota->personil_id;
            $status_anggota = 'personel';
        }
        $detailPresensiAnggota->update($validatedData);
        return redirect()->route('admin.absensi.show', ['tanggal_absensi' => $detailPresensiAnggota->tanggal_kehadiran, 'idAnggota' => $idAnggota, 'status_anggota' => $status_anggota])->with('success', 'Data presensi anggota berhasil diperbarui');
    }

    public function filterAbsensi(){
        return view('admin.absensi.filter');
    }

    public function filterAbsensiPost(Request $request){
        $validateData = $request->validate([
            'tanggal_absensi' => 'required|date_format:d-m-Y'
        ],[
            'tanggal_absensi.required' => 'Tanggal absensi harus diisi',
            'tanggal_absensi.date_format' => 'Tanggal absensi tidak sesuai dengan format: YYYY-MM-DD',
        ]);

        return redirect()->route('admin.absensi.filter.index', ['date' => $validateData['tanggal_absensi']])->with('success', 'Data absensi berhasil dicari');
    }

    public function indexFilterAbsensi($date){
        $time = strtotime($date);
        $date = date('Y-m-d', $time);
        $absensiPersonil = KehadiranModel::where('tanggal_kehadiran', $date)->where('pegawai_id', null)->get();

        $absensiPegawai = KehadiranModel::where('tanggal_kehadiran', $date)->where('personil_id', null)->get();
        // dd($absensiPersonil);
        
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
            'Ijin',
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

        return view('admin.absensi.indexFilter', compact('absensiPersonil', 'absensiPegawai', 'date', 'statusKehadiranIcon', 'bgStatusKehadiran', 'iconColor', 'statusKehadiran'));
    }

    public function cetakPresensiHarian($date){
        $time = strtotime($date);
        $date = date('Y-m-d', $time);
        $absensiPersonil = KehadiranModel::where('tanggal_kehadiran', $date)->where('pegawai_id', null)->get();

        $absensiPegawai = KehadiranModel::where('tanggal_kehadiran', $date)->where('personil_id', null)->get();

        return view('admin.absensi.cetak.cetak-presensi-harian', compact('absensiPersonil', 'absensiPegawai', 'date', ));
    }

    public function cetakPresensiMingguan($date){
        $time = strtotime($date);
        $date = date('Y-m-d', $time);
        $absensiPersonil = KehadiranModel::where('tanggal_kehadiran', $date)->where('pegawai_id', null)->get();

        $absensiPegawai = KehadiranModel::where('tanggal_kehadiran', $date)->where('personil_id', null)->get();

        return view('admin.absensi.cetak.cetak-presensi-mingguan', compact('absensiPersonil', 'absensiPegawai', 'date', ));
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

    public function generatePresensiPersonelToday($date)
    {
        $personilAll = PersonilModel::all();
        if ($personilAll->count()<=0) {
            return abort('404', 'Belum ada data personel di database');
        } else {
            $kehadiran = KehadiranModel::where('tanggal_kehadiran', $date)->where('pegawai_id', null)->get();
            // dd($kehadiran);
            if ($kehadiran->count()!=0) {
                return abort('404', 'data absensi '.$date.' sudah dibuat');
            } else {
                foreach ($personilAll as $personil) {
                    KehadiranModel::create([
                        'tanggal_kehadiran' => Carbon::createFromFormat('Y-m-d', $date),
                        'status_kehadiran'  => 'Belum Absen',
                        'personil_id'  => $personil->id,
                    ]);
                }
            }
            

            return redirect()->route('admin.absensi.index')->with('success', 'Data presensi personel hari ini berhasil dibuat');
        }


    }

    public function generatePresensiPegawaiToday($date)
    {
        $pegawaiAll = PegawaiModel::all();
        if ($pegawaiAll->count()<=0) {
            return abort('404', 'Belum ada data pegawai di database');
        } else {
            $kehadiran = KehadiranModel::where('tanggal_kehadiran', $date)->where('personil_id', null)->get();
            if ($kehadiran->count()!=0) {
                return abort('404', 'data absensi '.$date.' sudah dibuat');
            } else {
                foreach ($pegawaiAll as $pegawai) {
                    KehadiranModel::create([
                        'tanggal_kehadiran' => Carbon::createFromFormat('Y-m-d', $date),
                        'status_kehadiran'  => 'Belum Absen',
                        'pegawai_id'  => $pegawai->id,
                    ]);
                }
            }

            return redirect()->route('admin.absensi.index')->with('success', 'Data presensi pegawai hari ini berhasil dibuat');
        }


    }

    public function rekapDataYesterday()
    {
        
        $utc_timezone = new DateTimeZone("UTC");

        $tallinn_timezone = new DateTimeZone("Asia/Jakarta");

        // Create a new DateTime object in the UTC format

        $datetime = new DateTime("now", $utc_timezone);

        // Convert the DateTime object to the timezone of Tallinn
        $datetime->setTimezone($tallinn_timezone);

        $yesterday = $datetime->sub(new DateInterval('P1D'))->format('Y-m-d');

        $personilAll = personilModel::all();
        if ($personilAll->count()<=0) {
            return abort('404', 'Belum ada data personil di database');
        } else {
            $kehadiran = KehadiranModel::where('tanggal_kehadiran', $yesterday)->where('pegawai_id', null)->where('status_kehadiran', 'Belum Absen')->get();
            // dd($kehadiran);
            if ($kehadiran->count()==0) {
                return abort('404', 'rekap data absensi '.$yesterday.' sudah dibuat');
            } else {
                foreach ($kehadiran as $item) {
                    $item->update([
                        'status_kehadiran' => 'Tidak Hadir',
                    ]);
                }
            }

        }

        $pegawaiAll = pegawaiModel::all();
        if ($pegawaiAll->count()<=0) {
            return abort('404', 'Belum ada data pegawai di database');
        } else {
            $kehadiran = KehadiranModel::where('tanggal_kehadiran', $yesterday)->where('personil_id', null)->where('status_kehadiran', 'Belum Absen')->get();
            // dd($kehadiran);
            if ($kehadiran->count()==0) {
                return abort('404', 'data absensi '.$yesterday.' belum dibuat');
            } else {
                foreach ($kehadiran as $item) {
                    $item->update([
                        'status_kehadiran' => 'Tidak Hadir',
                    ]);
                }
            }

        }
        return redirect()->route('admin.absensi.index')->with('success', 'Data presensi personil hari ini berhasil dibuat');
    }

    public function hasilkanDataAbsensiBesok()
    {
        
        $utc_timezone = new DateTimeZone("UTC");

        $tallinn_timezone = new DateTimeZone("Asia/Jakarta");

        // Create a new DateTime object in the UTC format

        $datetime = new DateTime("now", $utc_timezone);

        // Convert the DateTime object to the timezone of Tallinn
        $datetime->setTimezone($tallinn_timezone);

        // Mendapatkan tanggal besok
        $tomorrow = $datetime->add(new DateInterval('P1D'))->format('Y-m-d');

        $personilAll = personilModel::all();
        if ($personilAll->count()<=0) {
            return abort('404', 'Belum ada data personil di database');
        } else {
            $kehadiran = KehadiranModel::where('tanggal_kehadiran', $tomorrow)->where('pegawai_id', null)->get();
            // dd($kehadiran);
            if ($kehadiran->count()!=0) {
                return abort('404', 'data absensi '.$tomorrow.' sudah dibuat');
            } else {
                foreach ($personilAll as $item) {
                    KehadiranModel::create([
                        'tanggal_kehadiran' => $tomorrow,
                        'status_kehadiran'  => 'Belum Absen',
                        'personil_id'  => $item->id, 
                    ]);
                }
            }

        }

        $pegawaiAll = pegawaiModel::all();
        if ($pegawaiAll->count()<=0) {
            return abort('404', 'Belum ada data pegawai di database');
        } else {
            $kehadiran = KehadiranModel::where('tanggal_kehadiran', $tomorrow)->where('personil_id', null)->get();
            // dd($kehadiran);
            if ($kehadiran->count()!=0) {
                return abort('404', 'data absensi '.$tomorrow.' sudah dibuat');
            } else {
                foreach ($pegawaiAll as $item) {
                    KehadiranModel::create([
                        'tanggal_kehadiran' => $tomorrow,
                        'status_kehadiran'  => 'Belum Absen',
                        'pegawai_id'  => $item->id, 
                    ]);
                }
            }

        }
        return redirect()->route('admin.absensi.index')->with('success', 'Data presensi personil besok berhasil dibuat');
    }
}
