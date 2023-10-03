<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PegawaiModel;
use Illuminate\Http\Request;

class PegawaiController extends Controller
{
    public function index($page) {
        $perPage = 10; // Jumlah data per halaman
        $totalPegawai = PegawaiModel::count();
        if ($totalPegawai == 0){
            $pegawai = PegawaiModel::all();
            $totalPages = 0;
            $firstNav = 1;
            $lastNav = 1;
            return view('admin.pegawai.index', compact('pegawai', 'page', 'totalPages', 'firstNav', 'lastNav'));
        }
        $totalPages = ceil($totalPegawai / $perPage);

        // Pastikan $page berada dalam rentang halaman yang valid
        if ($page <= 0 || $page > $totalPages) {
            return abort(404);
        }

        // Hitung batasan angka navigasi
        $maxNavLinks = 5;
        $halfMaxLinks = floor($maxNavLinks / 2);
        $firstNav = max(1, $page - $halfMaxLinks);
        $lastNav = min($totalPages, $firstNav + $maxNavLinks - 1);

        // Menghitung offset berdasarkan halaman yang diminta
        $offset = ($page - 1) * $perPage;

        // Mengambil data dengan offset berdasarkan halaman
        $pegawai = PegawaiModel::skip($offset)->take($perPage)->get();
        return view('admin.pegawai.index', compact('pegawai', 'page', 'totalPages', 'firstNav', 'lastNav'));
    
    }

    public function create()
    {
        return view('admin.pegawai.create');
    }

    public function store(Request $request)
    {
        $validateData = $request->validate([
            'nip' => 'required|unique:pegawai,nip|max:25',
            'nama_pegawai' => 'required|string',
            'jabatan' => 'required|string',
            'golongan' => 'required|string',
        ], [
            'nip.max' => 'NIP tidak sesuai format',
            'nip.unique' => 'NIP sudah digunakan.',
        ]);
        
        PegawaiModel::create($validateData);
        return redirect()->route('admin.pegawai.index', ['page' => 1])->with('success', 'Data Pegawai berhasil ditambahkan.');
        
    }

    public function destroy($id){
        $pegawai = PegawaiModel::find($id);
        // dd($pegawai);
        if (!$pegawai) {
            return abort(404);
        }

        $pegawai->delete();

        return redirect()->route('admin.pegawai.index', ['page' => 1])
            ->with('success', 'Data Pegawai berhasil dihapus.');
    }

}
