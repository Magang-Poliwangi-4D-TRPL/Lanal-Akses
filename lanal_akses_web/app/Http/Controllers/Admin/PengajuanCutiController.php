<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CutiModel;
use App\Models\DataCutiPersonelModel;
use App\Models\PengajuanCutiModel;
use App\Models\PersonilModel;
use App\Models\ResponCutiModel;
use App\Models\SisaCutiModel;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;

class PengajuanCutiController extends Controller
{
    //
    public function index() {
        // Pengajuan cuti yang statusnya masih menunggu persetujuan di tahap manapun
        $pengajuanMenunggu = PengajuanCutiModel::whereHas('responCuti', function ($query) {
            $query->where('status_komandan', 'Menunggu Persetujuan');
        })->orderBy('status', 'asc')->get();

        // Pengajuan cuti yang sudah selesai (disetujui atau ditolak oleh komandan)
        $pengajuanSelesai = PengajuanCutiModel::whereHas('responCuti', function ($query) {
            $query->where('status_komandan', 'disetujui')
                  ->orWhere('status_atasan', 'ditolak')
                  ->orWhere('status_palaksa', 'ditolak')
                  ->orWhere('status_sekretaris', 'ditolak')
                  ->orWhere('status_komandan', 'ditolak');
        })->get();

        $jenisCuti = CutiModel::all();

        return view('admin.pengajuan-cuti.index', compact('pengajuanMenunggu', 'pengajuanSelesai', 'jenisCuti'));
    }
    
    public function tambah(){
        // Mengambil hanya kolom 'id', 'nama', dan 'nrp' untuk personil
    $personilList = PersonilModel::select('id', 'nama_lengkap', 'nrp')->get();

    // Mengambil semua role, lalu mengecualikan role 'PersonilModel' dan 'pegawai'
    $excludedRoles = ['personel', 'pegawai', 'admin'];
    $roles = Role::whereNotIn('name', $excludedRoles)->pluck('name');

    // Mengambil personil yang memiliki user dengan role selain 'personil' dan 'pegawai'
    $atasanList = User::with('personil')
        ->whereHas('roles', function ($query) use ($excludedRoles) {
            $query->whereNotIn('name', $excludedRoles);
        })
        ->whereNotNull('personil_id') // Hanya user yang memiliki relasi dengan personil
        ->join('personil', 'users.personil_id', '=', 'personil.id')
        ->select('personil.id as id', 'personil.nama_lengkap', 'personil.nrp')
        ->get();

    $dataCuti = CutiModel::all();

    return view('admin.pengajuan-cuti.tambah', compact('personilList', 'atasanList', 'dataCuti'));
    }

    public function store(Request $request){
        // Validasi input
        $request->validate([
            'personil_id' => 'required|exists:personil,id',
            'tanggal_mulai_cuti' => 'required|date|after_or_equal:today',
            'tanggal_selesai_cuti' => 'required|date|after_or_equal:tanggal_mulai_cuti',
            'atasan_id' => 'required|exists:personil,id',
            'jenis_cuti' => 'required',
            'alasan_cuti' => 'nullable|string|max:500',
            'no_telepon' => 'required|string|max:20',
            'alamat_cuti' => 'nullable|string|max:255',
        ], [
            'tanggal_mulai_cuti.after_or_equal' => 'Tanggal mulai cuti tidak boleh sebelum hari ini!',
            'tanggal_selesai_cuti.after_or_equal' => 'Tanggal selesai cuti tidak boleh sebelum tanggal mulai cuti!',
        ]);

        $jenisCuti = CutiModel::where('kode_cuti', $request->jenis_cuti)->first();
        $jumlahHariYangDiambil = $this->calculateDays($request->tanggal_mulai_cuti, $request->tanggal_selesai_cuti);
        if ($jenisCuti == null) {
            return redirect()->back()->with('error', 'Data jenis cuti tidak ditemukan!');
        } else {
            if ( $jumlahHariYangDiambil > $jenisCuti->jumlah_hari_cuti) {
                return redirect()->back()->with('error', "Jumlah hari yang diambil melebihi batas jumlah hari cuti yang dipilih! \n" . "Jumlah hari yang diambil : ". $jumlahHariYangDiambil. "\n Batas hari yang diperbolehkan : ". $jenisCuti->jumlah_hari_cuti);
            } 
        }
        
        
        // dd($request);
    
        // Ambil data personil dan jenis cuti terkait
        $personil = PersonilModel::find($request->personil_id);
        $komandan = PersonilModel::whereHas('user', function($query) {
            $query->role('komandan');
        })->first();
        $palaksa = PersonilModel::whereHas('user', function($query) {
            $query->role('palaksa');
        })->first();
        $sekretaris = PersonilModel::whereHas('user', function($query) {
            $query->role('paset');
        })->first();

        // Simpan pengajuan cuti
        $pengajuanCuti = new PengajuanCutiModel();
        $pengajuanCuti->personil_id = $request->personil_id;
        $pengajuanCuti->tanggal_mulai_cuti = $request->tanggal_mulai_cuti;
        $pengajuanCuti->tanggal_selesai_cuti = $request->tanggal_selesai_cuti;
        $pengajuanCuti->cuti_id = $jenisCuti->id;
        $pengajuanCuti->status = 'Menunggu Persetujuan';
        $pengajuanCuti->alasan_cuti = $request->alasan_cuti;
        $pengajuanCuti->no_telepon = $request->no_telepon;
        $pengajuanCuti->alamat_cuti = $request->alamat_cuti;
        $pengajuanCuti->atasan_id = $request->atasan_id;
        $pengajuanCuti->jenis_cuti = $request->jenis_cuti;
        $pengajuanCuti->keterangan = $request->keterangan;
        $pengajuanCuti->save();
        // dd($pengajuanCuti);

        // Simpan respon cuti
        $responCuti = ResponCutiModel::create([
            'pengajuan_cuti_id' => $pengajuanCuti->id,
            'atasan_id' => $pengajuanCuti->atasan_id,
            'status_atasan' => 'Menunggu Persetujuan',
            'palaksa_id' => $palaksa->id,
            'status_palaksa' => 'Menunggu Persetujuan',
            'sekretaris_id' => $sekretaris->id,
            'status_sekretaris' => 'Menunggu Persetujuan',
            'komandan_id' => $komandan->id,
            'status_komandan' => 'Menunggu Persetujuan',
        ]);

        
        $dataCutiPersonel = DataCutiPersonelModel::create([
            "personil_id" => $request->personil_id,
            "cuti_id" => $jenisCuti->id,
            "pengajuan_cuti_id" => $pengajuanCuti->id,
            'tanggal_mulai' => $request->tanggal_mulai_cuti,
            'tanggal_selesai' => $request->tanggal_selesai_cuti,
            'jumlah_hari' => $jumlahHariYangDiambil,
        ]);
    
        return redirect()->route('admin.surat-cuti.index')->with('success', 'Pengajuan cuti berhasil dibuat.');
    }


    public function show($id){
        $suratPengajuan = PengajuanCutiModel::find($id);
        // dd($suratPengajuan);
        // return "berhasil menampilkan surat cuti";

        if ($suratPengajuan == null) {
            return abort('404', 'Surat cuti tidak ditemukan');
        }

        return view('admin.pengajuan-cuti.show', compact('suratPengajuan'));
    }


    /**
     * Menghitung jumlah hari antara dua tanggal.
     */
    private function calculateDays($startDate, $endDate)
    {
        $start = new \DateTime($startDate);
        $end = new \DateTime($endDate);
        return $end->diff($start)->days + 1;
    }

    // Controller Untuk Respon Kepala Satuan Kerja
    public function indexSatker() {
        $satker = Auth::user()->personil;
        
        $pengajuanMenunggu = PengajuanCutiModel::where('atasan_id', $satker->id)->whereHas('responCuti', function ($query) {
            $query->where('status_atasan', 'Menunggu Persetujuan');
        })->get();;
        
        
        // Pengajuan cuti yang sudah selesai (disetujui atau ditolak oleh komandan)
        $pengajuanSelesai = PengajuanCutiModel::where('atasan_id', $satker->id)->whereHas('responCuti', function ($query) {
            $query->where('status_atasan', 'disetujui')
                  ->orWhere('status_atasan', 'ditolak');
        })->get();

        return view('admin.pengajuan-cuti.satker.index', compact('pengajuanMenunggu', 'pengajuanSelesai'));
    }

    public function showSatker($id) {
        $suratPengajuan = PengajuanCutiModel::find($id);
        // dd($id);
        // return "berhasil menampilkan surat cuti";

        if ($suratPengajuan == null) {
            return abort('404', 'Surat cuti tidak ditemukan');
        }

        return view('admin.pengajuan-cuti.satker.show', compact('suratPengajuan'));
    }

    public function createResponSatker($id, Request $request){

        $request->validate([
            'status_atasan' => 'required|string',
            'keterangan_atasan' => 'nullable|string',
        ]);

        $suratPengajuan = PengajuanCutiModel::find($id);
        if ($suratPengajuan == null) {
            return abort('404', 'Surat cuti tidak ditemukan');
        }

        $responCuti = ResponCutiModel::where('pengajuan_cuti_id', $id)->get()->first();

        if ($request->status_atasan == "Disetujui") {
            $responCuti->update([
                'status_atasan' => $request->status_atasan,
                'keterangan_atasan' => $request->keterangan_atasan
            ]);
    
            $suratPengajuan->update([
                'status' => "Disetujui Atasan",
            ]);
    
            return redirect()->route('admin.surat-cuti.satker.index')->with('success', 'Respon anda berhasil direkam.');
        } elseif($request->status_atasan == "Ditolak") {
            $responCuti->update([
                'status_atasan' => $request->status_atasan,
                'status_palaksa' => $request->status_atasan,
                'status_sekretaris' => $request->status_atasan,
                'status_komandan' => $request->status_atasan,
                'keterangan_atasan' => $request->keterangan_atasan
            ]);
    
            $suratPengajuan->update([
                'status' => "Ditolak",
                'keterangan' => $suratPengajuan->keterangan . "\n pesan atasan:" . $request->keterangan_atasan
            ]);
    
            return redirect()->route('admin.surat-cuti.satker.index')->with('success', 'Respon anda berhasil direkam.');
        } else {
            return redirect()->route('admin.surat-cuti.satker.index')->with('error', 'Maaf sepertinya terdapat kesalahan pada respon anda');
        }
        

        

    }

    // Controller Untuk Respon Palaksa
    public function indexPalaksa() {
        $palaksa = Auth::user()->personil;
        
        $pengajuanMenunggu = PengajuanCutiModel::whereHas('responCuti', function ($query) use($palaksa) {
            $query->where('status_palaksa', 'Menunggu Persetujuan');
        })->get();;
        
        
        // Pengajuan cuti yang sudah selesai (disetujui atau ditolak oleh komandan)
        $pengajuanSelesai = PengajuanCutiModel::whereHas('responCuti', function ($query) use($palaksa) {
            $query->where('status_palaksa', 'disetujui')
            ->orWhere('status_palaksa', 'ditolak');
        })->get();

        return view('admin.pengajuan-cuti.palaksa.index', compact('pengajuanMenunggu', 'pengajuanSelesai'));
    }

    public function showPalaksa($id) {
        $suratPengajuan = PengajuanCutiModel::find($id);
        // dd($id);
        // return "berhasil menampilkan surat cuti";

        if ($suratPengajuan == null) {
            return abort('404', 'Surat cuti tidak ditemukan');
        }

        return view('admin.pengajuan-cuti.palaksa.show', compact('suratPengajuan'));
    }

    public function createResponPalaksa($id, Request $request){

        $request->validate([
            'status_palaksa' => 'required|string',
            'keterangan_palaksa' => 'nullable|string',
        ]);

        $suratPengajuan = PengajuanCutiModel::find($id);
        if ($suratPengajuan == null) {
            return abort('404', 'Surat cuti tidak ditemukan');
        }

        $responCuti = ResponCutiModel::where('pengajuan_cuti_id', $id)->get()->first();

        if ($request->status_palaksa == "Disetujui") {
            $responCuti->update([
                'status_palaksa' => $request->status_palaksa,
                'keterangan_palaksa' => $request->keterangan_palaksa
            ]);
    
            $suratPengajuan->update([
                'status' => "Disetujui Palaksa",
            ]);
    
            return redirect()->route('admin.surat-cuti.palaksa.index')->with('success', 'Respon anda berhasil direkam.');
        } elseif($request->status_palaksa == "Ditolak") {
            $responCuti->update([
                'status_palaksa' => $request->status_palaksa,
                'status_sekretaris' => $request->status_palaksa,
                'status_komandan' => $request->status_palaksa,
                'keterangan_palaksa' => $request->keterangan_palaksa
            ]);
    
            $suratPengajuan->update([
                'status' => "Ditolak",
                'keterangan' => $suratPengajuan->keterangan . "\n pesan palaksa:" . $request->keterangan_palaksa
            ]);
    
            return redirect()->route('admin.surat-cuti.palaksa.index')->with('success', 'Respon anda berhasil direkam.');
        } else {
            return redirect()->route('admin.surat-cuti.palaksa.index')->with('error', 'Maaf sepertinya terdapat kesalahan pada respon anda');
        }
        

        

    }


    // Controller Untuk Respon Sekretaris
    public function indexSekretaris() {
        $sekretaris = Auth::user()->personil;
        
        $pengajuanMenunggu = PengajuanCutiModel::whereHas('responCuti', function ($query) use($sekretaris) {
            $query->where('status_sekretaris', 'Menunggu Persetujuan');
        })->get();;
        
        
        // Pengajuan cuti yang sudah selesai (disetujui atau ditolak oleh sekretaris)
        $pengajuanSelesai = PengajuanCutiModel::whereHas('responCuti', function ($query) use($sekretaris) {
            $query->where('status_sekretaris', 'disetujui')
            ->orWhere('status_sekretaris', 'ditolak');
        })->get();

        return view('admin.pengajuan-cuti.sekretaris.index', compact('pengajuanMenunggu', 'pengajuanSelesai'));
    }

    public function showSekretaris($id) {
        $suratPengajuan = PengajuanCutiModel::find($id);
        // dd($id);
        // return "berhasil menampilkan surat cuti";

        if ($suratPengajuan == null) {
            return abort('404', 'Surat cuti tidak ditemukan');
        }

        return view('admin.pengajuan-cuti.sekretaris.show', compact('suratPengajuan'));
    }

    public function createResponSekretaris($id, Request $request){

        $request->validate([
            'status_sekretaris' => 'required|string',
            'keterangan_sekretaris' => 'nullable|string',
            'nomor_surat' => 'nullable|string',
        ]);

        $suratPengajuan = PengajuanCutiModel::find($id);
        if ($suratPengajuan == null) {
            return abort('404', 'Surat cuti tidak ditemukan');
        }

        $responCuti = ResponCutiModel::where('pengajuan_cuti_id', $id)->get()->first();

        if ($request->status_sekretaris == "Disetujui") {
            $responCuti->update([
                'status_sekretaris' => $request->status_sekretaris,
                'keterangan_sekretaris' => $request->keterangan_sekretaris
            ]);

            if ($request->nomor_surat != null) {
                # code...
                $suratPengajuan->update([
                    'status' => "Disetujui Sekretaris",
                    'nomor_surat' => $request->nomor_surat,
                ]);
            } else {
                $suratPengajuan->update([
                    'status' => "Disetujui Sekretaris",
                ]);
            }
    
            return redirect()->route('admin.surat-cuti.sekretaris.index')->with('success', 'Respon anda berhasil direkam.');
        } elseif($request->status_sekretaris == "Ditolak") {
            $responCuti->update([
                'status_sekretaris' => $request->status_sekretaris,
                'status_komandan' => $request->status_sekretaris,
                'keterangan_sekretaris' => $request->keterangan_sekretaris
            ]);
    
            $suratPengajuan->update([
                'status' => "Ditolak",
                'keterangan' => $suratPengajuan->keterangan . "\n pesan sekretaris:" . $request->keterangan_sekretaris
            ]);
    
            return redirect()->route('admin.surat-cuti.sekretaris.index')->with('success', 'Respon anda berhasil direkam.');
        } else {
            return redirect()->route('admin.surat-cuti.sekretaris.index')->with('error', 'Maaf sepertinya terdapat kesalahan pada respon anda');
        }
        
    }

    public function editNomorSurat($id){
        $suratPengajuan = PengajuanCutiModel::find($id);

        return view('admin.pengajuan-cuti.sekretaris.editNoSurat', compact('suratPengajuan'));
    }

    public function updateNomorSurat($id, Request $request){
        $request->validate([
            'nomor_surat' => 'required',
        ]);

        // dd($request);
        $suratPengajuan = PengajuanCutiModel::find($id);
        if ($suratPengajuan == null) {
            return abort('404', 'Surat cuti tidak ditemukan');
        }

        $suratPengajuan->update([
            'nomor_surat' => $request->nomor_surat,
        ]);


        return redirect()->route('admin.surat-cuti.sekretaris.index')->with('success', 'Berhasil memperbarui nomor surat cuti.');
    }

    // Controller Untuk Respon Palaksa
    public function indexKomandan() {
        $komandan = Auth::user()->personil;
        
        $pengajuanMenunggu = PengajuanCutiModel::whereHas('responCuti', function ($query) use($komandan) {
            $query->where('status_komandan', 'Menunggu Persetujuan');
        })->get();;
        
        
        // Pengajuan cuti yang sudah selesai (disetujui atau ditolak oleh komandan)
        $pengajuanSelesai = PengajuanCutiModel::whereHas('responCuti', function ($query) use($komandan) {
            $query->where('status_komandan', 'disetujui')
            ->orWhere('status_komandan', 'ditolak');
        })->get();

        return view('admin.pengajuan-cuti.komandan.index', compact('pengajuanMenunggu', 'pengajuanSelesai'));
    }

    public function showKomandan($id) {
        $suratPengajuan = PengajuanCutiModel::find($id);
        // dd($id);
        // return "berhasil menampilkan surat cuti";

        if ($suratPengajuan == null) {
            return abort('404', 'Surat cuti tidak ditemukan');
        }

        return view('admin.pengajuan-cuti.komandan.show', compact('suratPengajuan'));
    }

    public function createResponKomandan($id, Request $request){

        $request->validate([
            'status_komandan' => 'required|string',
            'keterangan_komandan' => 'nullable|string',
        ]);

        $suratPengajuan = PengajuanCutiModel::find($id);
        if ($suratPengajuan == null) {
            return abort('404', 'Surat cuti tidak ditemukan');
        }

        $responCuti = ResponCutiModel::where('pengajuan_cuti_id', $id)->get()->first();

        if ($request->status_komandan == "Disetujui") {
            $responCuti->update([
                'status_komandan' => $request->status_komandan,
                'keterangan_komandan' => $request->keterangan_komandan
            ]);
    
            $suratPengajuan->update([
                'status' => "Disetujui Komandan",
            ]);
    
            return redirect()->route('admin.surat-cuti.komandan.index')->with('success', 'Respon anda berhasil direkam.');
        } elseif($request->status_komandan == "Ditolak") {
            $responCuti->update([
                'status_komandan' => $request->status_komandan,
                'keterangan_komandan' => $request->keterangan_komandan
            ]);
    
            $suratPengajuan->update([
                'status' => "Ditolak",
                'keterangan' => $suratPengajuan->keterangan . "\n pesan komandan:" . $request->keterangan_komandan
            ]);
    
            return redirect()->route('admin.surat-cuti.komandan.index')->with('success', 'Respon anda berhasil direkam.');
        } else {
            return redirect()->route('admin.surat-cuti.komandan.index')->with('error', 'Maaf sepertinya terdapat kesalahan pada respon anda');
        }
        

        

    }
}
