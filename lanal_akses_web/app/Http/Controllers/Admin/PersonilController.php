<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DataKepangkatanModel;
use App\Models\KursusModel;
use App\Models\PendidikanFormalModel;
use App\Models\PendidikanMiliterModel;
use App\Models\PerlengkapanModel;
use App\Models\PersonilModel;
use App\Models\RiwayatPenugasanModel;
use App\Models\SanksiHukumanModel;
use App\Models\TandaJasaModel;
use App\Models\TanggunganKeluargaModel;
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

        // $pendidikanFormal = $personil->pendidikanFormal;
        // dd($personil);
        $imagePath = 'public/' . $personil->image_url;
        // dd(Storage::disk('local')->exists($imagePath));
        // return Storage::exists($imagePath)? 'true' : 'false';
        if (Storage::disk('local')->exists($imagePath)) {
            return "File gambar ditemukan";
        } else {
            return "File gambar tidak ditemukan";
        }
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
            $tanggungan_keluarga = TanggunganKeluargaModel::where('personil_id', $personil->id)->get();
            
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
            
            return view('admin.personil.show', compact('personil', 'pendidikanFormal', 'pendidikanMiliter', 'kursus', 'tanggungan_keluarga', 'perlengkapan', 'tandaJasa', 'dataKepangkatan', 'riwayatPenugasan', 'sanksiHukuman'));
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
            'jabatan' => 'required|string|max:50',
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
            'tinggi_beratbadan' => 'nullable',
            'agama_sukubangsa' => 'nullable',
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
            'tinggi_beratbadan' => $validatedData['tinggi_beratbadan'],
            'agama_sukubangsa' => $validatedData['agama_sukubangsa'],
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

        if (!$personil) {
            return abort(404);
        }

        $personil->delete();

        return redirect()->route('admin.personil.index', ['page' => 1])
            ->with('success', 'Data Personil berhasil dihapus.');
    }

}
