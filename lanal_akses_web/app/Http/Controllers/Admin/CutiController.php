<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CutiModel;
use App\Models\DataCutiPersonelModel;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class CutiController extends Controller
{
    // Menambahkan aturan untuk batasan sisa cuti 
    public function create(){
        return view('admin.pengajuan-cuti.cuti.create');
    }

    public function store(Request $request){
        $request->validate([
            'nama_cuti' => 'required|string|max:50',
            'kode_cuti' => 'required|string|unique:cuti,kode_cuti',
            'jumlah_hari_cuti' => 'required|integer|min:1',
            'deskripsi' => 'nullable|string',
        ], [
            'nama_cuti.max' => 'Nama cuti tidak boleh melebihi dari 50 karakter!',
            'kode_cuti.unique' => 'Kode cuti sudah pernah dipakai! coba gunakan kode lain',
            'jumlah_hari_cuti.min' => 'Batas jumlah hari harus diisi dengan minimal angka 1',
        ]);
        // dd($request);
        $responCuti = CutiModel::create([
            'nama_cuti' => $request->nama_cuti,
            'kode_cuti' => $request->kode_cuti,
            'jumlah_hari_cuti' => $request->jumlah_hari_cuti,
            'deskripsi' => $request->deskripsi,
        ]);
    
        return redirect()->route('admin.surat-cuti.index')->with('success', 'Data jenis cuti berhasil dibuat.');
    }

    public function edit($id){
        $cuti = CutiModel::find($id);

        if ($cuti == null) {
            return redirect()->back()->withErrors(['message' =>  'Data jenis cuti tidak ditemukan!']);
        }

        return view('admin.pengajuan-cuti.cuti.edit', compact('cuti'));
    }

    public function update($id, Request $request)
    {
        $cuti = CutiModel::find($id);
        if ($cuti == null) {
            return abort(404, 'Data jenis cuti tidak ditemukan!');
        }

        $request->validate([
            'nama_cuti' => 'required|string|max:50',
            'kode_cuti' => [
                'required',
                'string',
                Rule::unique('cuti', 'kode_cuti')->ignore($cuti->id),
            ],
            'jumlah_hari_cuti' => 'required|integer|min:1',
            'deskripsi' => 'nullable|string',
        ], [
            'nama_cuti.max' => 'Nama cuti tidak boleh melebihi dari 50 karakter!',
            'kode_cuti.unique' => 'Kode cuti sudah pernah dipakai! coba gunakan kode lain',
            'jumlah_hari_cuti.min' => 'Batas jumlah hari harus diisi dengan minimal angka 1',
        ]);

        $cuti->update([
            'nama_cuti' => $request->nama_cuti,
            'kode_cuti' => $request->kode_cuti,
            'jumlah_hari_cuti' => $request->jumlah_hari_cuti,
            'deskripsi' => $request->deskripsi,
        ]);

        return redirect()->route('admin.surat-cuti.index')->with('success', 'Data jenis cuti berhasil diperbarui!');
    }

    public function delete($id)
    {
        $cuti = CutiModel::find($id);
        if ($cuti == null) {
            return abort(404, 'Data jenis cuti tidak ditemukan!');
        }

        $cuti->delete();
        return redirect()->route('admin.surat-cuti.index')->with('success', 'Data jenis cuti berhasil dihapus.');
    }
}
