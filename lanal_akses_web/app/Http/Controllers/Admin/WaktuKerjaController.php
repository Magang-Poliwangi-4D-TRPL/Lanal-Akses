<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\WaktuKerjaModel;
use Illuminate\Http\Request;

class WaktuKerjaController extends Controller
{
    
    public function create() {
        return view('admin.absensi.jam-kerja.create');
    }


    public function store(Request $request){
        $validatedData = $request->validate([
            'nama_waktu_kerja' => 'required|string|max:255',
            'jam_masuk_mulai' => 'required|date_format:H:i',
            'jam_masuk_selesai' => 'required|date_format:H:i',
            'jam_pulang_mulai' => 'required|date_format:H:i',
            'jam_pulang_selesai' => 'required|date_format:H:i',
            'jam_istirahat_mulai' => 'nullable|date_format:H:i',
            'jam_istirahat_selesai' => 'nullable|date_format:H:i',
            'keterangan' => 'nullable|string',
        ], [
            'nama_waktu_kerja.required' => 'Nama lengkap harus diisi.',
            'jam_masuk_mulai.date_format' => 'Format waktu masuk harus sesuai dengan format jam dan menit (HH:MM).',
            'jam_masuk_selesai.date_format' => 'Format Batas waktu masuk harus sesuai dengan format jam dan menit (HH:MM).',
            'jam_pulang_mulai.date_format' => 'Format waktu pulang harus sesuai dengan format jam dan menit (HH:MM).',
            'jam_pulang_selesai.date_format' => 'Format Batas waktu pulang harus sesuai dengan format jam dan menit (HH:MM).',
            'jam_istirahat_mulai.date_format' => 'Format waktu istirahat harus sesuai dengan format jam dan menit (HH:MM).',
            'jam_istirahat_selesai.date_format' => 'Format Batas waktu istirahat harus sesuai dengan format jam dan menit (HH:MM).',
        ]);
        
        WaktuKerjaModel::create($validatedData);

        return redirect()->route('admin.absensi.index')->with('success', 'Data jam kerja berhasil ditambahkan.');
    }

    public function edit($idWaktuKerja) {
        $informasiJamKerja = WaktuKerjaModel::find($idWaktuKerja);

        if ($informasiJamKerja == null){
            return abort(404, 'informasi jam kerja tidak ditemukan');
        } else {
            
            return view('admin.absensi.jam-kerja.edit', compact('informasiJamKerja'));
        }

    }

    public function update($idWaktuKerja, Request $request) {
        // Validasi data
        $validatedData = $request->validate([
            'nama_waktu_kerja' => 'required|string|max:255',
            'jam_masuk_mulai' => 'required|date_format:H:i',
            'jam_masuk_selesai' => 'required|date_format:H:i|after:jam_masuk_mulai',
            'jam_pulang_mulai' => 'required|date_format:H:i',
            'jam_pulang_selesai' => 'required|date_format:H:i|after:jam_pulang_mulai',
            'jam_istirahat_mulai' => 'nullable|date_format:H:i',
            'jam_istirahat_selesai' => 'nullable|date_format:H:i|after:jam_istirahat_mulai',
            'keterangan' => 'nullable|string',
        ]);
    
        // Cari informasi jam kerja
        $informasiJamKerja = WaktuKerjaModel::find($idWaktuKerja);
    
        // Periksa apakah informasi jam kerja ditemukan
        if (!$informasiJamKerja) {
            return abort(404, 'Informasi jam kerja tidak ditemukan');
        }
    
        // Update informasi jam kerja
        $informasiJamKerja->update($validatedData);
    
        // Redirect dengan pesan sukses
        return redirect()->route('admin.absensi.index')->with('success', 'Data presensi berhasil diperbarui.');
    }
    

}
