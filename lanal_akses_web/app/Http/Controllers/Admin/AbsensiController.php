<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\KehadiranModel;
use App\Models\PegawaiModel;
use App\Models\PersonilModel;
use App\Models\WaktuKerjaModel;
use PDF;
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
        
        // Ambil data kehadiran dari satu bulan terakhir
        $startDate = Carbon::now()->startOfMonth();
        $endDate = Carbon::now()->endOfMonth();

        $jumlahKehadiranPersonelBulanIni =  KehadiranModel::whereNotIn('status_kehadiran', ['Belum Absen'])
                                                            ->whereBetween('tanggal_kehadiran', [$startDate, $endDate])->where('pegawai_id', null)
                                                            ->count();
        $jumlahKehadiranPegawaiBulanIni =  KehadiranModel::whereNotIn('status_kehadiran', ['Belum Absen'])
                                                            ->whereBetween('tanggal_kehadiran', [$startDate, $endDate])->where('personil_id', null)
                                                            ->count();

        // Cek apakah ada data kehadiran personil
        $personilPresensi = KehadiranModel::where('pegawai_id', null)
            ->whereBetween('tanggal_kehadiran', [$startDate, $endDate])->exists();

        // Cek apakah ada data kehadiran pegawai
        $pegawaiPresensi = KehadiranModel::where('personil_id', null)
            ->whereBetween('tanggal_kehadiran', [$startDate, $endDate])->exists();

        
            if (!$personilPresensi) {
                $personilStatusCounts = null;
            } else {
                // Hitung jumlah kehadiran berdasarkan status
                $personilhadir = KehadiranModel::where('status_kehadiran', 'Hadir')->where('pegawai_id', null)
                                        ->whereBetween('tanggal_kehadiran', [$startDate, $endDate])
                                        ->count();
        
                $personilterlambat = KehadiranModel::where('status_kehadiran', 'Terlambat')->where('pegawai_id', null)
                                            ->whereBetween('tanggal_kehadiran', [$startDate, $endDate])
                                            ->count();
        
                $personiltidakHadir = KehadiranModel::where('status_kehadiran', 'Tidak Hadir')->where('pegawai_id', null)
                                             ->whereBetween('tanggal_kehadiran', [$startDate, $endDate])
                                             ->count();
        
                // Tambahkan status lain jika ada
                $personilCuti = KehadiranModel::whereNotIn('status_kehadiran', ['Hadir', 'Terlambat', 'Tidak Hadir', 'Belum Absen'])
                                               ->whereBetween('tanggal_kehadiran', [$startDate, $endDate])->where('pegawai_id', null)
                                               ->count();
            
                                               // Data untuk dikirim ke view
                                               $personilStatusCounts = [
                                                   'Hadir' => $personilhadir,
                                                   'Terlambat' => $personilterlambat,
                                                   'Tidak Hadir' => $personiltidakHadir,
                                                   'Cuti' => $personilCuti
                                               ];
            }

        if (!$pegawaiPresensi) {
            $pegawaiStatusCounts = null;
        } else {
            // Hitung jumlah kehadiran berdasarkan status
            $pegawaihadir = KehadiranModel::where('status_kehadiran', 'Hadir')->where('personil_id', null)
            ->whereBetween('tanggal_kehadiran', [$startDate, $endDate])
            ->count();

                $pegawaiterlambat = KehadiranModel::where('status_kehadiran', 'Terlambat')->where('personil_id', null)
                        ->whereBetween('tanggal_kehadiran', [$startDate, $endDate])
                        ->count();

                $pegawaitidakHadir = KehadiranModel::where('status_kehadiran', 'Tidak Hadir')->where('personil_id', null)
                            ->whereBetween('tanggal_kehadiran', [$startDate, $endDate])
                            ->count();

                // Tambahkan status lain jika ada
                $pegawaistatusLainnya = KehadiranModel::whereNotIn('status_kehadiran', ['Hadir', 'Terlambat', 'Tidak Hadir', 'Belum Absen'])
                            ->whereBetween('tanggal_kehadiran', [$startDate, $endDate])->where('personil_id', null)
                            ->count();
                // Data untuk dikirim ke view
                $pegawaiStatusCounts = [
                'Hadir' => $pegawaihadir,
                'Terlambat' => $pegawaiterlambat,
                'Tidak Hadir' => $pegawaitidakHadir,
                'Cuti' => $pegawaistatusLainnya
                ];
        }
        


        return view('admin.absensi.index', compact('date', 'informasiJamKerja', 'countPresensiPersonilToday', 'countPresensiPegawaiToday', 'absensiPersonil', 'absensiPegawai', 'personilStatusCounts', 'pegawaiStatusCounts', 'jumlahKehadiranPegawaiBulanIni', 'jumlahKehadiranPersonelBulanIni'));
    }

    public function dataPresensi()
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
            'Hadir'=> 'check',
             'Tidak Hadir'=> 'xmark',
             'Terlambat'=>'clock',
             'Cuti Sakit'=>'file',
             'Cuti Tahunan'=>'file',
             'Belum Absen'=> 'circle-exclamation',
         ];
         $statusKehadiran = [
             'Hadir',
             'Tidak Hadir',
             'Terlambat',
             'Cuti Sakit',
             'Cuti Tahunan',
             'Belum Absen',
         ];
         $bgStatusKehadiran = [
            'Hadir'=>'success',
            'Tidak Hadir'=> 'danger',
            'Terlambat'=>'warning',
            'Cuti Sakit'=>'primary',
            'Cuti Tahunan'=>'primary',
            'Belum Absen'=>'secondary',
         ];
         $iconColor = [
            'Hadir'=>'text-success',
            'Tidak Hadir'=>'text-danger',
            'Terlambat'=>'text-warning',
            'Cuti Sakit'=>'text-primary',
            'Cuti Tahunan'=>'text-primary',
            'Belum Absen'=>'text-secondary',
         ];

        return view('admin.absensi.data-presensi', compact('absensiPersonil', 'absensiPegawai', 'date', 'statusKehadiranIcon', 'bgStatusKehadiran', 'iconColor', 'statusKehadiran', 'informasiJamKerja', 'countPresensiPersonilToday', 'countPresensiPegawaiToday'));
    }

    public function show($tanggal_kehadiran, $idAnggota, $status_anggota) {
        
        $statusKehadiranIcon = [
            'Hadir'=> 'check',
             'Tidak Hadir'=> 'xmark',
             'Terlambat'=>'clock',
             'Cuti Sakit'=>'file',
             'Cuti Tahunan'=>'file',
             'Belum Absen'=> 'circle-exclamation',
         ];
         $statusKehadiran = [
             'Hadir',
             'Tidak Hadir',
             'Terlambat',
             'Cuti Sakit',
             'Cuti Tahunan',
             'Belum Absen',
         ];
         $bgStatusKehadiran = [
             'Hadir'=>'success',
            'Tidak Hadir'=> 'danger',
             'Terlambat'=>'warning',
             'Cuti Sakit'=>'primary',
             'Cuti Tahunan'=>'primary',
             'Belum Absen'=>'secondary',
         ];
         $iconColor = [
            'Hadir'=>'text-success',
            'Tidak Hadir'=>'text-danger',
            'Terlambat'=>'text-warning',
            'Cuti Sakit'=>'text-primary',
            'Cuti Tahunan'=>'text-primary',
            'Belum Absen'=>'text-secondary',
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
            'jam_masuk' => 'nullable|',
            'jam_pulang' => 'nullable|',
            'status_kehadiran' => 'required',
            'lokasi' => 'required',
            'keterangan' => 'nullable|max:255',
        ], [
            // 'jam_masuk.required' => 'Jam masuk harus diisi.',
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
            'tanggal_absensi' => 'required|date_format:Y-m-d'
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
           'Hadir'=> 'check',
            'Tidak Hadir'=> 'xmark',
            'Terlambat'=>'clock',
            'Cuti Sakit'=>'file',
            'Cuti Tahunan'=>'file',
            'Belum Absen'=> 'circle-exclamation',
        ];
        $statusKehadiran = [
            'Hadir',
            'Tidak Hadir',
            'Terlambat',
            'Cuti Sakit',
            'Cuti Tahunan',
            'Belum Absen',
        ];
        $bgStatusKehadiran = [
            'Hadir'=>'success',
           'Tidak Hadir'=> 'danger',
            'Terlambat'=>'warning',
            'Cuti Sakit'=>'primary',
            'Cuti Tahunan'=>'primary',
            'Belum Absen'=>'secondary',
        ];
        $iconColor = [
            'Hadir'=>'text-success',
            'Tidak Hadir'=>'text-danger',
            'Terlambat'=>'text-warning',
            'Cuti Sakit'=>'text-primary',
            'Cuti Tahunan'=>'text-primary',
            'Belum Absen'=>'text-secondary',
        ];

        return view('admin.absensi.indexFilter', compact('absensiPersonil', 'absensiPegawai', 'date', 'statusKehadiranIcon', 'bgStatusKehadiran', 'iconColor', 'statusKehadiran'));
    }

    public function cetakPresensiHarian($date){
        $time = strtotime($date);
        $date = date('Y-m-d', $time);
        $absensiPersonil = KehadiranModel::where('tanggal_kehadiran', $date)->where('pegawai_id', null)->get();
        $absensiPegawai = KehadiranModel::where('tanggal_kehadiran', $date)->where('personil_id', null)->get();

        // Render view ke PDF
        $pdf = PDF::loadView('admin.absensi.cetak.cetak-presensi-harian', compact('absensiPersonil', 'absensiPegawai', 'date'))
                ->setPaper('a4', 'potrait'); 

        // Download atau tampilkan PDF
        return $pdf->stream('rekap-presensi-harian-'.$date.'.pdf');
    }

    public function filterPresensiMingguan(){
        return view('admin.absensi.filter-mingguan');
    }

    public function cetakPresensiMingguan(Request $request) {
        $validateData = $request->validate([
            'startDate' => 'required|date_format:Y-m-d',
        ],[
            'startDate.required' => 'Tanggal mulai presensi harus diisi',
            'startDate.date_format' => 'Tanggal mulai presensi tidak sesuai dengan format: YYYY-MM-DD',
        ]);
        $startDate = Carbon::parse( $validateData["startDate"]);
        $endDate = Carbon::parse( $validateData["startDate"])->subDay(6);

        // Ambil data kehadiran personel dan pegawai berdasarkan rentang tanggal
        $absensiPersonil = KehadiranModel::whereBetween('tanggal_kehadiran', [$endDate, $startDate])
            ->where('pegawai_id', null)
            ->get();
    
        $absensiPegawai = KehadiranModel::whereBetween('tanggal_kehadiran', [$endDate, $startDate])
            ->where('personil_id', null)
            ->get();
    
        // Mengirim data ke view dengan format PDF menggunakan DomPDF
        $pdf = PDF::loadView('admin.absensi.cetak.cetak-presensi-mingguan', compact('absensiPersonil', 'absensiPegawai', 'startDate', 'endDate'))->setPaper('a4', 'potrait');
        return $pdf->stream('rekap-presensi-mingguan.pdf');
    }
    
    
    public function cetakPresensiBulanan(){
        $startDate = Carbon::now()->startOfMonth();
        $endDate = Carbon::now()->endOfMonth();
        $jumlahHari = $startDate->daysInMonth;
    
        // Ambil data kehadiran personel dan pegawai berdasarkan rentang tanggal
        $absensiPersonil = KehadiranModel::whereBetween('tanggal_kehadiran', [$startDate, $endDate])
            ->where('pegawai_id', null)
            ->get();
    
        $absensiPegawai = KehadiranModel::whereBetween('tanggal_kehadiran', [$startDate, $endDate])
            ->where('personil_id', null)
            ->get();
    
        // Mengirim data ke view dengan format PDF menggunakan DomPDF
        $pdf = PDF::loadView('admin.absensi.cetak.cetak-presensi-bulanan', compact('absensiPersonil', 'absensiPegawai', 'startDate', 'endDate', 'jumlahHari'))->setPaper('a4', 'landscape');
        return $pdf->stream('rekap-presensi-bulanan.pdf');
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
