<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\InformasiAnakModel;
use App\Models\InformasiOrangTuaModel;
use App\Models\InformasiPasanganModel;
use App\Models\PersonilModel;
use Illuminate\Http\Request;

class InformasiKeluargaController extends Controller
{
    public function index($nrp) {
        $nrpGanti = str_replace('-', '/', $nrp);
        $personil = PersonilModel::where('nrp', $nrpGanti)->first();
        
        if($personil == null){
            return abort(404);
        } else {
            // Mengambil semua data tabel informasi pasangan 
            $informasiPasangan = InformasiPasanganModel::where('personil_id', $personil->id)->get();
            
            // Mengambil semua data tabel informasi anak 
            $informasiAnak = InformasiAnakModel::where('personil_id', $personil->id)->get();
            
            // Mengambil semua data tabel informasi orang tua 
            $informasiOrangTua = InformasiOrangTuaModel::where('personil_id', $personil->id)->get();

            return view('admin.personil.informasi-keluarga.index', compact('personil', 'informasiPasangan', 'informasiAnak', 'informasiOrangTua'));
        }

    }

    public function createInformasiPasangan($nrp){
        $nrpGanti = str_replace('-', '/', $nrp);
        $personil = PersonilModel::where('nrp', $nrpGanti)->first();
        
        if($personil == null){
            return abort(404, 'Data personil tidak ditemukan');
        } else {
            return view('admin.personil.informasi-keluarga.informasi-pasangan.create', compact('personil'));
        }
    }

    public function storeInformasiPasangan(Request $request, $nrp){
        $nrpGanti = str_replace('-', '/', $nrp);
        $personil = PersonilModel::where('nrp', $nrpGanti)->first();
        
        if($personil == null){
            return abort(404, 'Data personil tidak ditemukan');
        }

        // dd($request);
        
        // Validasi data yang masuk
        $validatedData = $request->validate([
            'nama_lengkap' => 'required|string|max:50',
            'tempat_lahir' => 'nullable|string|max:50',
            'tanggal_lahir' => 'nullable|date|date_format:d-m-Y',
            'agama' => 'nullable|regex:/^[a-zA-Z]+$/u',
            'suku_bangsa' => 'nullable|regex:/^[a-zA-Z]+$/u',
            'tinggi_badan' => 'nullable',
            'berat_badan' => 'nullable',
            'golongan_darah' => 'nullable',
            'pekerjaan' => 'nullable|string|max:50',
            'alamat_sekarang' => 'nullable',
            'nomor_kpi' => 'nullable',
            'tempat_nikah' => 'nullable',
            'nomor_surat_nikah' => 'nullable',
            'nomor_kta_jalasenastri' => 'nullable',
            'personil_id' => 'required',
        ],);

        // Simpan data informasi pasangan
        $informasiPasangan = new InformasiPasanganModel([
            'nama_lengkap' => $validatedData['nama_lengkap'],
            'tempat_lahir' => $validatedData['tempat_lahir'],
            'tanggal_lahir' => $validatedData['tanggal_lahir'],
            'agama' => $validatedData['agama'],
            'suku_bangsa' => $validatedData['suku_bangsa'],
            'tinggi_badan' => $validatedData['tinggi_badan'],
            'berat_badan' => $validatedData['berat_badan'],
            'golongan_darah' => $validatedData['golongan_darah'],
            'pekerjaan' => $validatedData['pekerjaan'],
            'alamat_sekarang' => $validatedData['alamat_sekarang'],
            'nomor_kpi' => $validatedData['nomor_kpi'],
            'tempat_nikah' => $validatedData['tempat_nikah'],
            'nomor_surat_nikah' => $validatedData['nomor_surat_nikah'],
            'nomor_kta_jalasenastri' => $validatedData['nomor_kta_jalasenastri'],
            'personil_id' => $validatedData['personil_id'],
        ]);

        // Hubungkan dengan personil
        $informasiPasangan->save();

        return redirect()->route('admin.personil.informasi-keluarga.index', ['nrp' => $nrp])
            ->with('success', 'Data pasangan personil berhasil ditambahkan.');
    }

    public function editInformasiPasangan($nrp, $informasiPasanganId){
        $nrpGanti = str_replace('-', '/', $nrp);
        $personil = PersonilModel::where('nrp', $nrpGanti)->first();

        if ($personil == null) {
            return abort(404, 'Data personel tidak ditemukan');
        }

        $informasiPasangan = informasiPasanganModel::where('personil_id', $personil->id)
            ->find($informasiPasanganId);

        if ($informasiPasangan == null) {
            return abort(404, 'Data informasi pasangan tidak ditemukan');
        }

        return view('admin.personil.informasi-keluarga.informasi-pasangan.edit', compact('personil', 'informasiPasangan'));
    }

    public function updateInformasiPasangan(Request $request, $nrp, $informasiPasanganId) {
        // Validasi data yang masuk
        $validatedData = $request->validate([
            'nama_lengkap' => 'required|string|max:50',
            'tempat_lahir' => 'nullable|string|max:50',
            'tanggal_lahir' => 'nullable|date|date_format:d-m-Y',
            'agama' => 'nullable|regex:/^[a-zA-Z]+$/u',
            'suku_bangsa' => 'nullable|regex:/^[a-zA-Z]+$/u',
            'tinggi_badan' => 'nullable',
            'berat_badan' => 'nullable',
            'golongan_darah' => 'nullable',
            'pekerjaan' => 'nullable|string|max:50',
            'alamat_sekarang' => 'nullable',
            'nomor_kpi' => 'nullable',
            'tempat_nikah' => 'nullable',
            'nomor_surat_nikah' => 'nullable',
            'nomor_kta_jalasenastri' => 'nullable',
        ],);
        
        $nrpGanti = str_replace('-', '/', $nrp);
        $personil = PersonilModel::where('nrp', $nrpGanti)->first();

        if ($personil == null) {
            return abort(404, 'Data personel tidak ditemukan');
        }

        $informasiPasangan = informasiPasanganModel::where('personil_id', $personil->id)
            ->find($informasiPasanganId);

        if ($informasiPasangan == null) {
            return abort(404, 'Data informasi pasangan tidak ditemukan');
        }

        // Update data informasiPasangan
        $informasiPasangan->update([
            'nama_lengkap' => $validatedData['nama_lengkap'],
            'tempat_lahir' => $validatedData['tempat_lahir'],
            'tanggal_lahir' => $validatedData['tanggal_lahir'],
            'agama' => $validatedData['agama'],
            'suku_bangsa' => $validatedData['suku_bangsa'],
            'tinggi_badan' => $validatedData['tinggi_badan'],
            'berat_badan' => $validatedData['berat_badan'],
            'golongan_darah' => $validatedData['golongan_darah'],
            'pekerjaan' => $validatedData['pekerjaan'],
            'alamat_sekarang' => $validatedData['alamat_sekarang'],
            'nomor_kpi' => $validatedData['nomor_kpi'],
            'tempat_nikah' => $validatedData['tempat_nikah'],
            'nomor_surat_nikah' => $validatedData['nomor_surat_nikah'],
            'nomor_kta_jalasenastri' => $validatedData['nomor_kta_jalasenastri'],
        ]);

        return redirect()->route('admin.personil.informasi-keluarga.index', ['nrp' => $nrp])->with('success', 'Data pasangan personil berhasil diperbarui.');

    }

    public function deleteInformasiPasangan($nrp, $informasiPasanganId){
        $nrpGanti = str_replace('-', '/', $nrp);
        $personil = PersonilModel::where('nrp', $nrpGanti)->first();

        if ($personil == null) {
            return abort(404, 'Data personel tidak ditemukan');
        }

        $informasiPasangan = informasiPasanganModel::where('personil_id', $personil->id)
            ->find($informasiPasanganId);

        if ($informasiPasangan == null) {
            return abort(404, 'Data informasi pasangan tidak ditemukan');
        }

        // Hapus data informasiPasangan
        $informasiPasangan->delete();

        return redirect()->route('admin.personil.informasi-keluarga.index', ['nrp' => $nrp])
            ->with('success', 'Data informasi pasangan personil berhasil dihapus.');
    } 

    

    public function createInformasiOrangTua($nrp){
        $nrpGanti = str_replace('-', '/', $nrp);
        $personil = PersonilModel::where('nrp', $nrpGanti)->first();
        
        if($personil == null){
            return abort(404, 'Data personil tidak ditemukan');
        } else {
            return view('admin.personil.informasi-keluarga.informasi-orang-tua.create', compact('personil'));
        }
    }

    public function storeInformasiOrangTua(Request $request, $nrp){
        $nrpGanti = str_replace('-', '/', $nrp);
        $personil = PersonilModel::where('nrp', $nrpGanti)->first();
        
        if($personil == null){
            return abort(404, 'Data personil tidak ditemukan');
        }

        // dd($request);
        
        // Validasi data yang masuk
        $validatedData = $request->validate([
            'nama_lengkap' => 'required|string|max:50',
            'agama' => 'required|string|max:50',
            'status_hubungan' => 'required',
            'personil_id' => 'required',
        ],);

        // Simpan data informasi Orang Tua
        $informasiOrangTua = new InformasiOrangTuaModel([
            'nama_lengkap' => $validatedData['nama_lengkap'],
            'agama' => $validatedData['agama'],
            'status_hubungan' => $validatedData['status_hubungan'],
            'personil_id' => $validatedData['personil_id'],
        ]);

        // Hubungkan dengan personil
        $informasiOrangTua->save();

        return redirect()->route('admin.personil.informasi-keluarga.index', ['nrp' => $nrp])
            ->with('success', 'Data Orang Tua personil berhasil ditambahkan.');
    }

    
    public function editInformasiOrangTua($nrp, $informasiOrangTuaId){
        $nrpGanti = str_replace('-', '/', $nrp);
        $personil = PersonilModel::where('nrp', $nrpGanti)->first();

        if ($personil == null) {
            return abort(404, 'Data personel tidak ditemukan');
        }

        $informasiOrangTua = informasiOrangTuaModel::where('personil_id', $personil->id)
            ->find($informasiOrangTuaId);

        if ($informasiOrangTua == null) {
            return abort(404, 'Data informasi orang tua tidak ditemukan');
        }

        return view('admin.personil.informasi-keluarga.informasi-orang-tua.edit', compact('personil', 'informasiOrangTua'));
    }

    public function updateInformasiOrangTua(Request $request, $nrp, $informasiOrangTuaId) {
        // Validasi data yang masuk
        $validatedData = $request->validate([
            'nama_lengkap' => 'required|string|max:50',
            'agama' => 'required|string|max:50',
            'status_hubungan' => 'required',
        ],);
        
        $nrpGanti = str_replace('-', '/', $nrp);
        $personil = PersonilModel::where('nrp', $nrpGanti)->first();

        if ($personil == null) {
            return abort(404, 'Data personel tidak ditemukan');
        }

        $informasiOrangTua = informasiOrangTuaModel::where('personil_id', $personil->id)
            ->find($informasiOrangTuaId);

        if ($informasiOrangTua == null) {
            return abort(404, 'Data informasi orang tua tidak ditemukan');
        }

        // Update data informasi Orang Tua
        $informasiOrangTua->update([
            'nama_lengkap' => $validatedData['nama_lengkap'],
            'agama' => $validatedData['agama'],
            'status_hubungan' => $validatedData['status_hubungan'],
        ]);

        return redirect()->route('admin.personil.informasi-keluarga.index', ['nrp' => $nrp])->with('success', 'Data orang tua personil berhasil diperbarui.');

    }

    public function deleteInformasiOrangTua($nrp, $informasiOrangTuaId){
        $nrpGanti = str_replace('-', '/', $nrp);
        $personil = PersonilModel::where('nrp', $nrpGanti)->first();

        if ($personil == null) {
            return abort(404, 'Data personel tidak ditemukan');
        }

        $informasiOrangTua = informasiOrangTuaModel::where('personil_id', $personil->id)
            ->find($informasiOrangTuaId);

        if ($informasiOrangTua == null) {
            return abort(404, 'Data informasi orang tua tidak ditemukan');
        }

        // Hapus data informasi Orang Tua
        $informasiOrangTua->delete();

        return redirect()->route('admin.personil.informasi-keluarga.index', ['nrp' => $nrp])
            ->with('success', 'Data informasi orang tua personil berhasil dihapus.');
    } 
    

    public function createInformasiAnak($nrp){
        $nrpGanti = str_replace('-', '/', $nrp);
        $personil = PersonilModel::where('nrp', $nrpGanti)->first();
        
        if($personil == null){
            return abort(404, 'Data personil tidak ditemukan');
        } else {
            return view('admin.personil.informasi-keluarga.informasi-anak.create', compact('personil'));
        }
    }

    public function storeInformasiAnak(Request $request, $nrp){
        $nrpGanti = str_replace('-', '/', $nrp);
        $personil = PersonilModel::where('nrp', $nrpGanti)->first();
        
        if($personil == null){
            return abort(404, 'Data personil tidak ditemukan');
        }

        // dd($request);
        
        // Validasi data yang masuk
        $validatedData = $request->validate([
            'nama_lengkap' => 'required|string|max:50',
            'tempat_lahir' => 'nullable|string|max:50',
            'tanggal_lahir' => 'nullable|date|date_format:d-m-Y',
            'jenis_kelamin' => 'required',
            'personil_id' => 'required',
        ],);

        // Simpan data informasi Anak
        $informasiAnak = new InformasiAnakModel([
            'nama_lengkap' => $validatedData['nama_lengkap'],
            'tempat_lahir' => $validatedData['tempat_lahir'],
            'tanggal_lahir' => $validatedData['tanggal_lahir'],
            'jenis_kelamin' => $validatedData['jenis_kelamin'],
            'personil_id' => $validatedData['personil_id'],
        ]);

        // Hubungkan dengan personil
        $informasiAnak->save();

        return redirect()->route('admin.personil.informasi-keluarga.index', ['nrp' => $nrp])
            ->with('success', 'Data anak personil berhasil ditambahkan.');
    }

    
    public function editInformasiAnak($nrp, $informasiAnakId){
        $nrpGanti = str_replace('-', '/', $nrp);
        $personil = PersonilModel::where('nrp', $nrpGanti)->first();

        if ($personil == null) {
            return abort(404, 'Data personel tidak ditemukan');
        }

        $informasiAnak = informasiAnakModel::where('personil_id', $personil->id)
            ->find($informasiAnakId);

        if ($informasiAnak == null) {
            return abort(404, 'Data informasi anak tidak ditemukan');
        }

        return view('admin.personil.informasi-keluarga.informasi-anak.edit', compact('personil', 'informasiAnak'));
    }

    public function updateInformasiAnak(Request $request, $nrp, $informasiAnakId) {
        // Validasi data yang masuk
        $validatedData = $request->validate([
            'nama_lengkap' => 'required|string|max:50',
            'tempat_lahir' => 'nullable|string|max:50',
            'tanggal_lahir' => 'nullable|date|date_format:d-m-Y',
            'jenis_kelamin' => 'required',
        ],);
        
        $nrpGanti = str_replace('-', '/', $nrp);
        $personil = PersonilModel::where('nrp', $nrpGanti)->first();

        if ($personil == null) {
            return abort(404, 'Data personel tidak ditemukan');
        }

        $informasiAnak = informasiAnakModel::where('personil_id', $personil->id)
            ->find($informasiAnakId);

        if ($informasiAnak == null) {
            return abort(404, 'Data informasi anak tidak ditemukan');
        }

        // Update data informasiAnak
        $informasiAnak->update([
            'nama_lengkap' => $validatedData['nama_lengkap'],
            'tempat_lahir' => $validatedData['tempat_lahir'],
            'tanggal_lahir' => $validatedData['tanggal_lahir'],
            'jenis_kelamin' => $validatedData['jenis_kelamin'],
        ]);

        return redirect()->route('admin.personil.informasi-keluarga.index', ['nrp' => $nrp])->with('success', 'Data anak personil berhasil diperbarui.');

    }

    public function deleteInformasiAnak($nrp, $informasiAnakId){
        $nrpGanti = str_replace('-', '/', $nrp);
        $personil = PersonilModel::where('nrp', $nrpGanti)->first();

        if ($personil == null) {
            return abort(404, 'Data personel tidak ditemukan');
        }

        $informasiAnak = informasiAnakModel::where('personil_id', $personil->id)
            ->find($informasiAnakId);

        if ($informasiAnak == null) {
            return abort(404, 'Data informasi anak tidak ditemukan');
        }

        // Hapus data informasiAnak
        $informasiAnak->delete();

        return redirect()->route('admin.personil.informasi-keluarga.index', ['nrp' => $nrp])
            ->with('success', 'Data informasi anak personil berhasil dihapus.');
    } 
}
