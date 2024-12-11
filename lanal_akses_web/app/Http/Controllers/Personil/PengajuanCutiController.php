<?php

namespace App\Http\Controllers\Personil;

use App\Http\Controllers\Controller;
use App\Models\CutiModel;
use App\Models\DataCutiPersonelModel;
use App\Models\PengajuanCutiModel;
use App\Models\PersonilModel;
use App\Models\ResponCutiModel;
use App\Models\SisaCutiModel;
use Carbon\Carbon;
use DateTime;
use DateTimeZone;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;

class PengajuanCutiController extends Controller
{
    public function index() {
        $personelId = auth()->user()->personil->id;
        // Pengajuan cuti yang statusnya masih menunggu persetujuan di tahap manapun
        $pengajuan_saat_ini = PengajuanCutiModel::where('personil_id', $personelId)->whereHas('responCuti', function ($query) {
            $query->where('status_komandan', 'Menunggu Persetujuan');
        })->orderBy('created_at', 'DESC')->first();

        // Pengajuan cuti yang sudah selesai (disetujui atau ditolak oleh komandan)
        $riwayat_pengajuan_cuti = PengajuanCutiModel::where('personil_id', $personelId)->whereHas('responCuti', function ($query) {
            $query->where('status_komandan', 'disetujui')
                  ->orWhere('status_atasan', 'ditolak')
                  ->orWhere('status_palaksa', 'ditolak')
                  ->orWhere('status_sekretaris', 'ditolak')
                  ->orWhere('status_komandan', 'ditolak');
        })->orderBy('created_at', 'DESC')->get();

        
        $dataCuti = DB::table('cuti')
        ->leftJoin('data_cuti_personel', function ($join) use ($personelId) {
            $join->on('cuti.id', '=', 'data_cuti_personel.cuti_id')
                ->where('data_cuti_personel.personil_id', '=', $personelId);
        })
        ->select(
            'cuti.nama_cuti',
            'cuti.kode_cuti',
            'cuti.jumlah_hari_cuti',
            DB::raw('COALESCE(SUM(data_cuti_personel.jumlah_hari), 0) as total_hari_diambil'),
            DB::raw('(cuti.jumlah_hari_cuti - COALESCE(SUM(data_cuti_personel.jumlah_hari), 0)) as sisa_hari_cuti')
        )
        ->groupBy('cuti.id')
        ->get();
        // dd($pengajuan_saat_ini);
        // session()->flash('success', 'Berhasil menampilkan halaman pengajuan cuti.');
        return view('personil.pengajuan-cuti.index', compact('pengajuan_saat_ini', 'riwayat_pengajuan_cuti', 'dataCuti'));
    }

    public function create(){
        $personelId = auth()->user()->personil->id;
        $excludedRoles = ['personel', 'pegawai'];
        $roles = Role::whereNotIn('name', $excludedRoles)->pluck('name');
        // Mengambil personil yang memiliki user dengan role selain 'personil' dan 'pegawai'
        $atasanList = PersonilModel::whereHas('user', function ($query) use ($roles) {
            $query->role($roles);
        })->select('id', 'nama_lengkap', 'nrp')->get();
        $dataCuti = DB::table('cuti')
        ->leftJoin('data_cuti_personel', function ($join) use ($personelId) {
            $join->on('cuti.id', '=', 'data_cuti_personel.cuti_id')
                ->where('data_cuti_personel.personil_id', '=', $personelId);
        })
        ->select(
            'cuti.nama_cuti',
            'cuti.kode_cuti',
            'cuti.jumlah_hari_cuti',
            DB::raw('COALESCE(SUM(data_cuti_personel.jumlah_hari), 0) as total_hari_diambil'),
            DB::raw('(cuti.jumlah_hari_cuti - COALESCE(SUM(data_cuti_personel.jumlah_hari), 0)) as sisa_hari_cuti')
        )
        ->groupBy('cuti.id')
        ->get();

        return view('personil.pengajuan-cuti.create', compact('atasanList', 'dataCuti'));
    }

    public function store(Request $request){
        $request->validate([
            'personil_id' => 'required|exists:personil,id',
            'tanggal_mulai_cuti' => 'required|date|after_or_equal:today',
            'tanggal_selesai_cuti' => 'required|date|after_or_equal:tanggal_mulai_cuti',
            'atasan_id' => 'required|exists:personil,id',
            'jenis_cuti' => 'required|string|max:255',
            'alasan_cuti' => 'nullable|string|max:500',
            'no_telepon' => 'required|string|max:20',
            'alamat_cuti' => 'nullable|string|max:255',
        ]);

        
        // Ambil data personil dan sisa cuti terkait
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
        $sisaCuti = SisaCutiModel::where('personil_id', $request->personil_id)->first();
    
        // Jenis cuti yang tidak mengurangi sisa cuti tahunan
        $jenisCutiTanpaPengurangan = ['melahirkan', 'ibadah haji', 'dinas lama', 'hamil'];
    
        // Cek apakah cuti mengurangi sisa cuti tahunan atau tidak
        if (!in_array($request->jenis_cuti, $jenisCutiTanpaPengurangan)) {
            // Jenis cuti mengurangi sisa cuti tahunan, cek apakah sisa cuti cukup
            if ($sisaCuti && ($sisaCuti->sisa_cuti - $this->calculateDays($request->tanggal_mulai_cuti, $request->tanggal_selesai_cuti)) < 0) {
                return redirect()->back()->withErrors(['message' => 'Sisa cuti tidak mencukupi.']);
            }
    
            // Update sisa cuti jika jenis cuti mengurangi sisa cuti tahunan
            $sisaCuti->update([
                'sisa_cuti' => $sisaCuti->sisa_cuti - $this->calculateDays($request->tanggal_mulai_cuti, $request->tanggal_selesai_cuti)
            ]);
        }
    
        // Simpan pengajuan cuti
        $pengajuanCuti = new PengajuanCutiModel();
        $pengajuanCuti->personil_id = $request->personil_id;
        $pengajuanCuti->tanggal_mulai_cuti = $request->tanggal_mulai_cuti;
        $pengajuanCuti->tanggal_selesai_cuti = $request->tanggal_selesai_cuti;
        $pengajuanCuti->sisa_cuti_id = $sisaCuti ? $sisaCuti->id : null;
        $pengajuanCuti->status = 'Menunggu Persetujuan';
        $pengajuanCuti->alasan_cuti = $request->alasan_cuti;
        $pengajuanCuti->no_telepon = $request->no_telepon;
        $pengajuanCuti->alamat_cuti = $request->alamat_cuti;
        $pengajuanCuti->atasan_id = $request->atasan_id;
        $pengajuanCuti->jenis_cuti = $request->jenis_cuti;
        $pengajuanCuti->keterangan = $request->keterangan;
        $pengajuanCuti->save();
    
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
    
        return redirect()->route('personil.pengajuan-cuti.index')->with('success', 'Pengajuan cuti berhasil dibuat.');
    }

    public function show($id){
        $suratPengajuan = PengajuanCutiModel::find($id);
        // dd($id);
        // return "berhasil menampilkan surat cuti";

        if ($suratPengajuan == null) {
            return abort('404', 'Surat cuti tidak ditemukan');
        }

        return view('personil.pengajuan-cuti.detail', compact('suratPengajuan'));
    }


    private function calculateDays($startDate, $endDate)
    {
        $start = new \DateTime($startDate);
        $end = new \DateTime($endDate);
        return $end->diff($start)->days + 1;
    }

}
