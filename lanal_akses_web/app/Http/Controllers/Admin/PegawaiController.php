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

    public function show($nip) {
        $nipGanti = str_replace('-', ' ', $nip);
        $pegawai = PegawaiModel::where('nip', $nipGanti)->first();

        // $pendidikanFormal = $pegawai->pendidikanFormal;

        if($pegawai==null){
            return abort(404);
        } else {
            // dd($pegawai);
            if($pegawai == null){
                return abort(404);
            } else {
                return view('admin.pegawai.show', compact('pegawai'));
            }

        }
    }

    public function search(Request $request) {
        $perPage = 100; // Jumlah data per halaman
        $query = $request->input('q');

        // Query pencarian berdasarkan nama atau NIP
        $pegawai = PegawaiModel::where('nama_pegawai', 'like', '%' . $query . '%')
            ->orWhere('nip', 'like', '%' . $query . '%')
            ->paginate($perPage);

        return view('admin.pegawai.search', compact('pegawai'));
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

    public function edit($nip){
        $nipGanti = str_replace('-', ' ', $nip);
        $pegawai = PegawaiModel::where('nip', $nipGanti)->first();
        // dd($pegawai);
        if (!$pegawai) {
            return abort(404);
        }

        return view('admin.pegawai.edit', compact('pegawai'));
    }

    public function update(Request $request, $nip)
    {
        $nipGanti = str_replace('-', ' ', $nip);
        $pegawai = PegawaiModel::where('nip', $nipGanti)->first();
        // Validasi data yang masuk
        $validatedData = $request->validate([
            'nama_pegawai' => 'required|string|max:50',
            'jabatan' => 'required|string|max:50',
            'golongan' => 'required|string|max:50',
            'email' => 'nullable|email',
            'no_telepon' => 'nullable',
            'alamat' => 'nullable',
        ],);

        if ($pegawai == null) {
            return abort(404);
        }


        // // Update data pegawai
        $pegawai->update([
            'nama_pegawai' => $validatedData['nama_pegawai'],
            'jabatan' => $validatedData['jabatan'],
            'golongan' => $validatedData['golongan'],
            'email' => $validatedData['email'],
            'alamat' => $validatedData['alamat'],
            'no_telepon' => $validatedData['no_telepon'],
        ]);

        return redirect()->route('admin.pegawai.show', ['nip' => $nip])->with('success', 'Data pegawai berhasil diperbarui.');
    }

    public function destroy($nip){
        $nipGanti = str_replace('-', '/', $nip);
        $pegawai = PegawaiModel::where('nip', $nipGanti)->first();
        // dd($pegawai);
        if (!$pegawai) {
            return abort(404);
        }

        $pegawai->delete();

        return redirect()->route('admin.pegawai.index', ['page' => 1])
            ->with('success', 'Data Pegawai berhasil dihapus.');
    }

}
