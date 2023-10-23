<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\KursusModel;
use App\Models\PendidikanFormalModel;
use App\Models\PendidikanMiliterModel;
use App\Models\PersonilModel;
use App\Models\TanggunganKeluargaModel;
use Illuminate\Http\Request;

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

        if($personil==null){
            return abort(404);
        } else {
            // dd($personil);
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
                
                return view('admin.personil.show', compact('personil', 'pendidikanFormal', 'pendidikanMiliter', 'kursus', 'tanggungan_keluarga'));
            }

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
