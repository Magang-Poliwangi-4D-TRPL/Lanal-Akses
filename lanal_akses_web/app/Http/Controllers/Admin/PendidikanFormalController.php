<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PendidikanFormalModel;
use App\Models\PersonilModel;
use Illuminate\Http\Request;

class PendidikanFormalController extends Controller
{
    
    public function index2() {
        $pendidikanFormal = PendidikanFormalModel::all();
        // dd($pendidikanFormal);
        
        if($pendidikanFormal==null){
            return abort(404);
        } else {
            // dd($personil);
            return view('admin.personil.pendidikan-formal.index2', compact('pendidikanFormal'));

        }

    }

    public function index($nrp) {
        $nrpGanti = str_replace('-', '/', $nrp);
        $personil = PersonilModel::where('nrp', $nrpGanti)->first();
        
        if($personil == null){
            return abort(404);
        } else {
            // Mengambil semua data PendidikanFormalModel yang memiliki personil_id yang sama dengan id PersonilModel yang dicari
            $pendidikanFormal = PendidikanFormalModel::where('personil_id', $personil->id)->get();
            
            return view('admin.personil.pendidikan-formal.index', compact('personil', 'pendidikanFormal'));
        }

    }

    public function create($nrp)
    {
        $nrpGanti = str_replace('-', '/', $nrp);
        $personil = PersonilModel::where('nrp', $nrpGanti)->first();
        return view('admin.personil.pendidikan-formal.create', compact('personil'));
    }

    public function store(Request $request, $nrp)
    {
        // Validasi data yang masuk
        $validatedData = $request->validate([
            'nama_pendidikan' => 'required|string|max:255',
            'lama_pendidikan' => 'required|string|max:255',
            'tahun_lulus' => 'required|numeric',
            'keterangan' => 'nullable|string',
            'personil_id' => 'required',
        ]);
        
        $nrpGanti = str_replace('-', '/', $nrp);
        $personil = PersonilModel::where('nrp', $nrpGanti)->first();
        
        // Simpan data pendidikan formal
        $pendidikanFormal = new PendidikanFormalModel([
            'nama_pendidikan' => $validatedData['nama_pendidikan'],
            'lama_pendidikan' => $validatedData['lama_pendidikan'],
            'tahun_lulus' => $validatedData['tahun_lulus'],
            'keterangan' => $validatedData['keterangan'],
            'personil_id' => $validatedData['personil_id'],
        ]);

        // Hubungkan dengan personil
        $pendidikanFormal->save();

        return redirect()->route('admin.personil.pendidikanformal.index', ['nrp' => $nrp])
            ->with('success', 'Data pendidikan formal berhasil ditambahkan.');
    }

}
