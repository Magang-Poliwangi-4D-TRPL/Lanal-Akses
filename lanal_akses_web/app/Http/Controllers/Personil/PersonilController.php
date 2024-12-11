<?php

namespace App\Http\Controllers\Personil;

use App\Http\Controllers\Controller;
use App\Models\DataKepangkatanModel;
use App\Models\InformasiAnakModel;
use App\Models\InformasiOrangTuaModel;
use App\Models\InformasiPasanganModel;
use App\Models\KehadiranModel;
use App\Models\KursusModel;
use App\Models\PendidikanFormalModel;
use App\Models\PendidikanMiliterModel;
use App\Models\PerlengkapanModel;
use App\Models\PersonilModel;
use App\Models\RiwayatPenugasanModel;
use App\Models\SanksiHukumanModel;
use App\Models\TandaJasaModel;
use App\Models\TanggunganKeluargaModel;
use App\Models\User;
use PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PersonilController extends Controller
{
    public function personilDashboard(){

        $personil = Auth::user()->personil;
        if ($personil == null) {
            $pendidikanFormal = null;
            $pendidikanMiliter = null;
            $kursus = null;
            $tanggunganKeluarga = null;
            $perlengkapan = null;
            $tandaJasa = null;
            $dataKepangkatan = null;
            $riwayatPenugasan = null;
            $sanksiHukuman = null;
            $informasiPasangan = null;
            $informasiAnak = null;
            $informasiOrangTua = null;
        } else {
            $pendidikanFormal = PendidikanFormalModel::where('personil_id', $personil->id)->get();
            $pendidikanMiliter = PendidikanMiliterModel::where('personil_id', $personil->id)->get();
            $kursus = KursusModel::where('personil_id', $personil->id)->get();
            $tanggunganKeluarga = TanggunganKeluargaModel::where('personil_id', $personil->id)->get();
            $perlengkapan = PerlengkapanModel::where('personil_id', $personil->id)->get();
            $tandaJasa = TandaJasaModel::where('personil_id', $personil->id)->get();
            $dataKepangkatan = DataKepangkatanModel::where('personil_id', $personil->id)->get();
            $riwayatPenugasan = RiwayatPenugasanModel::where('personil_id', $personil->id)->get();
            $sanksiHukuman = SanksiHukumanModel::where('personil_id', $personil->id)->get();
            $informasiPasangan = InformasiPasanganModel::where('personil_id', $personil->id)->first();
            $informasiAnak = InformasiAnakModel::where('personil_id', $personil->id)->get();
            $informasiOrangTua = InformasiOrangTuaModel::where('personil_id', $personil->id)->get();
        }
        
        return view('personil.dashboard', compact('pendidikanFormal', 'pendidikanMiliter', 'kursus', 'tanggunganKeluarga', 'perlengkapan', 'tandaJasa', 'dataKepangkatan', 'riwayatPenugasan', 'sanksiHukuman', 'informasiPasangan', 'informasiAnak', 'informasiOrangTua'));
    }
    
    public function edit(){
        $personil = Auth::user()->personil;
        if ($personil == null) {
            return redirect()->back()->withErrors(['message' => 'Data personel tidak ditemukan.']);
        } 
        return view('personil.edit', compact('personil'));
    }

    public function update(Request $request, $nrp){
        $nrpGanti = str_replace('-', '/', $nrp);
        $personil = PersonilModel::where('nrp', $nrpGanti)->first();
        // Validasi data yang masuk
        $validatedData = $request->validate([
            'nama_lengkap' => 'required|string|max:50',
            'jabatan' => 'required|string|max:250',
            'jenis_kelamin' => 'required',
            'pangkat' => 'nullable|string|max:25',
            'korps' => 'nullable',
            'pangkat_terakhir' => 'nullable',
            'tempat_dinas' => 'nullable',
            'tempat_armada' => 'nullable',
            'nomor_kta' => 'nullable|string|max:20',
            'nomor_ktp' => 'nullable|integer',
            'nomor_asbri' => 'nullable|string|max:8',
            'tempat_lahir' => 'nullable',
            'tanggal_lahir' => 'nullable',
            'tinggi_badan' => 'nullable',
            'berat_badan' => 'nullable',
            'agama' => 'nullable',
            'suku_bangsa' => 'nullable',
            'golongan_darah' => 'nullable',
            'dikspesialisasi' => 'nullable',
            'nilai_samata_stakes' => 'nullable',
            'kecakapan_bahasa' => 'nullable',
            'alamat_sekarang' => 'nullable|string',
            'nomor_hp' => 'nullable|string|',
            'status_rumah' => 'nullable',
        ],);

        if ($personil == null) {
            return redirect()->back()->withErrors(['message' => 'Data personel tidak ditemukan.']);
        }


        // // Update data personil
        $personil->update([
            'nama_lengkap' => $validatedData['nama_lengkap'],
            'jabatan' => $validatedData['jabatan'],
            'jenis_kelamin' => $validatedData['jenis_kelamin'],
            'pangkat' => $validatedData['pangkat'],
            'korps' => $validatedData['korps'],
            'pangkat_terakhir' => $validatedData['pangkat_terakhir'],
            'tempat_dinas' => $validatedData['tempat_dinas'],
            'nomor_kta' => $validatedData['nomor_kta'],
            'nomor_ktp' => $validatedData['nomor_ktp'],
            'nomor_asbri' => $validatedData['nomor_asbri'],
            'tempat_lahir' => $validatedData['tempat_lahir'],
            'tanggal_lahir' => $validatedData['tanggal_lahir'],
            'tinggi_badan' => $validatedData['tinggi_badan'],
            'berat_badan' => $validatedData['berat_badan'],
            'agama' => $validatedData['agama'],
            'suku_bangsa' => $validatedData['suku_bangsa'],
            'golongan_darah' => $validatedData['golongan_darah'],
            'dikspesialisasi' => $validatedData['dikspesialisasi'],
            'nilai_samata_stakes' => $validatedData['nilai_samata_stakes'],
            'kecakapan_bahasa' => $validatedData['kecakapan_bahasa'],
            'alamat_sekarang' => $validatedData['alamat_sekarang'],
            'status_rumah' => $validatedData['status_rumah'],
        ]);

        return redirect()->route('personil.dashboard', ['nrp' => $nrp])->with('success', 'Data personil berhasil diperbarui.');
    }

    public function upload(Request $request)
    {
        // Validasi form untuk memeriksa apakah file gambar diunggah
        $request->validate([
            'image' => 'required|image|mimes:jpeg,jpg,png|max:2048', // Sesuaikan dengan kebutuhan Anda
        ],[
            'image.required' => 'Gambar belum terupload atau belum diisi',
        ]);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->storeAs('public/images', $imageName);

            // Simpan informasi gambar di database jika diperlukan
            $personil = PersonilModel::where('nrp',  Auth::user()->personil->nrp)->first();
            if ($personil == null) {
                return redirect()->back()->withErrors(['message' => 'Data personel tidak ditemukan.']);
            } else {
                $personil->image_url = 'storage/images/' . $imageName;
                $personil->save();
            }
            return redirect()->route('personil.dashboard')->with('success', 'Foto personil berhasil diperbarui.');
        }

        return redirect()->back()->with('error', 'Pilih file gambar terlebih dahulu.');
    }


    public function editGambar(){
        $personil = PersonilModel::where('nrp',  Auth::user()->personil->nrp)->first();
        if($personil == null){
            return redirect()->back()->withErrors(['message' => 'Data personel tidak ditemukan.']);
        } else {
            return view('personil.upload-gambar', compact('personil'));
            
        }
    }
    
    public function absensi(){
        return view('personil.absensi');
    }

    public function perizinan(){
        return view('personil.perizinan');
    }
    
    public function login(){
        return view('personil.login');
    }
    
    public function loginPost(Request $request){
        $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);
        
        $user = User::all();
        if ($user->count() <= 0) {
            return abort('404', 'Belum ada akun yang dibuat');
        }
        
        dd($request);
    }

    public function cetakRiwayatHidup($nrp){
        $nrpGanti = str_replace('-', '/', $nrp);
        $personil = PersonilModel::where('nrp', $nrpGanti)->first();

        if($personil == null){
            return abort(404);
        } else {
            // Mengambil semua data PendidikanFormalModel yang memiliki personil_id yang sama dengan id PersonilModel yang dicari
            $pendidikanFormal = PendidikanFormalModel::where('personil_id', $personil->id)->get();
            
            // Mengambil semua data PendidikanMiliterModel yang memiliki personil_id yang sama dengan id PersonilModel yang dicari
            $pendidikanMiliter = PendidikanMiliterModel::where('personil_id', $personil->id)->get();
            
            // Mengambil semua data Kursus yang memiliki personil_id yang sama dengan id PersonilModel yang dicari
            $kursus = KursusModel::where('personil_id', $personil->id)->get();
            
            // Mengambil semua data TanggunganKeluarga yang memiliki personil_id yang sama dengan id PersonilModel yang dicari
            $tanggunganKeluarga = TanggunganKeluargaModel::where('personil_id', $personil->id)->get();
            
            // Mengambil semua data Perlengkapan yang memiliki personil_id yang sama dengan id PersonilModel yang dicari
            $perlengkapan = PerlengkapanModel::where('personil_id', $personil->id)->get();
            
            // Mengambil semua data TandaJasa yang memiliki personil_id yang sama dengan id PersonilModel yang dicari
            $tandaJasa = TandaJasaModel::where('personil_id', $personil->id)->get();
            
            // Mengambil semua data DataKepangkatanModel yang memiliki personil_id yang sama dengan id PersonilModel yang dicari
            $dataKepangkatan = DataKepangkatanModel::where('personil_id', $personil->id)->get();
            
            // Mengambil semua data RiwayatPenugasanModel yang memiliki personil_id yang sama dengan id PersonilModel yang dicari
            $riwayatPenugasan = RiwayatPenugasanModel::where('personil_id', $personil->id)->get();
            
            // Mengambil semua data SanksiHukumanModel yang memiliki personil_id yang sama dengan id PersonilModel yang dicari
            $sanksiHukuman = SanksiHukumanModel::where('personil_id', $personil->id)->get();
            
            // Mengambil semua data InformasiPasangan yang memiliki personil_id yang sama dengan id PersonilModel yang dicari
            $informasiPasangan = InformasiPasanganModel::where('personil_id', $personil->id)->get();
            
            
            // Mengambil semua data informasiAnak yang memiliki personil_id yang sama dengan id PersonilModel yang dicari
            $informasiAnak = InformasiAnakModel::where('personil_id', $personil->id)->get();
            
            
            // Mengambil semua data informasiOrangTua yang memiliki personil_id yang sama dengan id PersonilModel yang dicari
            $informasiOrangTua = InformasiOrangTuaModel::where('personil_id', $personil->id)->get();
            
            // $pdf = PDF::loadView('admin.personil.cetak.cetak-riwayat-hidup', compact('personil', 'pendidikanFormal', 'pendidikanMiliter', 'kursus', 'tanggunganKeluarga', 'perlengkapan', 'tandaJasa', 'dataKepangkatan', 'riwayatPenugasan', 'sanksiHukuman', 'informasiPasangan', 'informasiAnak', 'informasiOrangTua'))
            // ->setPaper('a4', 'potrait'); 
            // return $pdf->stream($personil->nama_lengkap . '_riwayat-hidup.pdf');
            return view('admin.personil.cetak.cetak-riwayat-hidup', compact('personil', 'pendidikanFormal', 'pendidikanMiliter', 'kursus', 'tanggunganKeluarga', 'perlengkapan', 'tandaJasa', 'dataKepangkatan', 'riwayatPenugasan', 'sanksiHukuman', 'informasiPasangan', 'informasiAnak', 'informasiOrangTua'));

        }
    }
    
}