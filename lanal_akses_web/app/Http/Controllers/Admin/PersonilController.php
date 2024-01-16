<?php

namespace App\Http\Controllers\Admin;

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
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PersonilController extends Controller
{
    public function index($page) {
            $perPage = 10; // Jumlah data per halaman
            $totalPersonil = PersonilModel::count();
            if ($totalPersonil == 0){
                $personil = PersonilModel::all();
                $totalPages = 0;
                $firstNav = 1;
                $lastNav = 1;
                return view('admin.personil.index', compact('personil', 'page', 'totalPages', 'firstNav', 'lastNav'));
            }
            $totalPages = ceil($totalPersonil / $perPage);

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
            $personil = PersonilModel::skip($offset)->take($perPage)->get();
            return view('admin.personil.index', compact('personil', 'page', 'totalPages', 'firstNav', 'lastNav'));
        
    }

    public function show($nrp) {
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
            
            // Mengambil semua data UserModel yang memiliki personil_id yang sama dengan id PersonilModel yang dicari
            $user = User::where('personil_id', $personil->id)->get();
            
            return view('admin.personil.show', compact('personil', 'pendidikanFormal', 'pendidikanMiliter', 'kursus', 'tanggunganKeluarga', 'perlengkapan', 'tandaJasa', 'dataKepangkatan', 'riwayatPenugasan', 'sanksiHukuman', 'informasiPasangan', 'informasiAnak', 'informasiOrangTua', 'user'));
        }

    }

    public function search(Request $request) {
        $perPage = 100; // Jumlah data per halaman
        $query = $request->input('q');

        // Query pencarian berdasarkan nama atau NRP
        $personil = PersonilModel::where('nama_lengkap', 'like', '%' . $query . '%')
            ->orWhere('nrp', 'like', '%' . $query . '%')
            ->paginate($perPage);

        return view('admin.personil.search', compact('personil'));
    }


    public function create()
    {
        return view('admin.personil.create');
    }

    public function store(Request $request){
        // dd($request->all());
        // Validasi input karyawan, misalnya nama, alamat, dll.
        $validatedData = $request->validate([
            'nama_lengkap' => 'required|string|max:255',
            'nrp'    => 'required|unique:personil,nrp|max:255',
            'jabatan'    => 'required|string|max:255',
            'jenis_kelamin'    => 'required',
            //Tambahkan validasi lain sesuai kebutuhan Anda.
        ], [
            'nama_lengkap.required' => 'Nama lengkap harus diisi.',
            'nrp.required' => 'NRP harus diisi.',
            'nrp.unique' => 'NRP sudah digunakan.',
            'jabatan.required' => 'Jabatan harus diisi.',
            'jenis_kelamin.required' => 'Jenis kelamin harus dipilih.',
        ]);
        
        PersonilModel::create($validatedData);
        // dd($validatedData);
        return redirect()->route('admin.personil.index', ['page' => 1])->with('success', 'Data Personil berhasil ditambahkan.');
    }

    public function edit($nrp){
        $personil = PersonilModel::where('nrp', str_replace('-', '/', $nrp))->first();

        if ($personil == null) {
            return abort(404, 'data personil tidak ditemukan');
        } else {
            return view('admin.personil.edit', compact('personil'));
        }
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
            return abort(404);
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

        return redirect()->route('admin.personil.show', ['nrp' => $nrp])->with('success', 'Data personil berhasil diperbarui.');
    }

    public function destroy($id){
        $personil = PersonilModel::find($id);
        if($personil == null){
            return abort(404);
        } else {
            // Mengambil semua data PendidikanFormalModel yang memiliki personil_id yang sama dengan id PersonilModel yang dicari
            $pendidikanFormal = PendidikanFormalModel::where('personil_id', $personil->id)->get();
            if($pendidikanFormal->count()!=0){
                foreach ($pendidikanFormal as $data){
                    $data->delete();
                }
            } 
            // Mengambil semua data pendidikanMiliterModel yang memiliki personil_id yang sama dengan id PersonilModel yang dicari
            $pendidikanMiliter = pendidikanMiliterModel::where('personil_id', $personil->id)->get();
            if($pendidikanMiliter->count()!=0){
                foreach ($pendidikanMiliter as $data){
                    $data->delete();
                }
            } 
            // Mengambil semua data kursusModel yang memiliki personil_id yang sama dengan id PersonilModel yang dicari
            $kursus = kursusModel::where('personil_id', $personil->id)->get();
            if($kursus->count()!=0){
                foreach ($kursus as $data){
                    $data->delete();
                }
            } 
            // Mengambil semua data tanggunganKeluargaModel yang memiliki personil_id yang sama dengan id PersonilModel yang dicari
            $tanggunganKeluarga = tanggunganKeluargaModel::where('personil_id', $personil->id)->get();
            if($tanggunganKeluarga->count()!=0){
                foreach ($tanggunganKeluarga as $data){
                    $data->delete();
                }
            } 
            // Mengambil semua data perlengkapanModel yang memiliki personil_id yang sama dengan id PersonilModel yang dicari
            $perlengkapan = perlengkapanModel::where('personil_id', $personil->id)->get();
            if($perlengkapan->count()!=0){
                foreach ($perlengkapan as $data){
                    $data->delete();
                }
            } 
            // Mengambil semua data tandaJasaModel yang memiliki personil_id yang sama dengan id PersonilModel yang dicari
            $tandaJasa = tandaJasaModel::where('personil_id', $personil->id)->get();
            if($tandaJasa->count()!=0){
                foreach ($tandaJasa as $data){
                    $data->delete();
                }
            } 
            // Mengambil semua data dataKepangkatanModel yang memiliki personil_id yang sama dengan id PersonilModel yang dicari
            $dataKepangkatan = dataKepangkatanModel::where('personil_id', $personil->id)->get();
            if($dataKepangkatan->count()!=0){
                foreach ($dataKepangkatan as $data){
                    $data->delete();
                }
            } 
            // Mengambil semua data riwayatPenugasanModel yang memiliki personil_id yang sama dengan id PersonilModel yang dicari
            $riwayatPenugasan = riwayatPenugasanModel::where('personil_id', $personil->id)->get();
            if($riwayatPenugasan->count()!=0){
                foreach ($riwayatPenugasan as $data){
                    $data->delete();
                }
            } 
            // Mengambil semua data sanksiHukumanModel yang memiliki personil_id yang sama dengan id PersonilModel yang dicari
            $sanksiHukuman = sanksiHukumanModel::where('personil_id', $personil->id)->get();
            if($sanksiHukuman->count()!=0){
                foreach ($sanksiHukuman as $data){
                    $data->delete();
                }
            } 
            // Mengambil semua data userModel yang memiliki personil_id yang sama dengan id PersonilModel yang dicari
            $user = User::where('personil_id', $personil->id)->get();
            if($user->count()!=0){
                foreach ($user as $data){
                    $data->delete();
                }
            } 
            // Mengambil semua data kehadiranModel yang memiliki personil_id yang sama dengan id PersonilModel yang dicari
            $kehadiran = KehadiranModel::where('personil_id', $personil->id)->get();
            if($kehadiran->count()!=0){
                foreach ($kehadiran as $data){
                    $data->delete();
                }
            } 
            $personil->delete();
        }


        return redirect()->route('admin.personil.index', ['page' => 1])
            ->with('success', 'Data Personil berhasil dihapus.');
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
            

            return view('admin.personil.cetak.cetak-riwayat-hidup', compact('personil', 'pendidikanFormal', 'pendidikanMiliter', 'kursus', 'tanggunganKeluarga', 'perlengkapan', 'tandaJasa', 'dataKepangkatan', 'riwayatPenugasan', 'sanksiHukuman', 'informasiPasangan', 'informasiAnak', 'informasiOrangTua'));
        }
    }

    public function cetakDataLengkap($nrp){
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
            

            return view('admin.personil.cetak.cetak-data-lengkap', compact('personil', 'pendidikanFormal', 'pendidikanMiliter', 'kursus', 'tanggunganKeluarga', 'perlengkapan', 'tandaJasa', 'dataKepangkatan', 'riwayatPenugasan', 'sanksiHukuman', 'informasiPasangan', 'informasiAnak', 'informasiOrangTua'));
        }
    }

    public function cetakDataPersonil(){
        $personil = PersonilModel::all();

        return view('admin.personil.cetak.cetak-data-personil', compact('personil',));
    }
}
