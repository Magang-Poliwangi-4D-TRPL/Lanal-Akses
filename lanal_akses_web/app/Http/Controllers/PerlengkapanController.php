<?php

namespace App\Http\Controllers;

use App\Models\PerlengkapanModel;
use App\Models\PersonilModel;
use Illuminate\Http\Request;

class PerlengkapanController extends Controller
{
    public function index($nrp) {
        $nrpGanti = str_replace('-', '/', $nrp);
        $personil = PersonilModel::where('nrp', $nrpGanti)->first();
        
        if($personil == null){
            return abort(404);
        } else {
            // Mengambil semua data PerlengkapanModel yang memiliki personil_id yang sama dengan id PersonilModel yang dicari
            $perlengkapan = PerlengkapanModel::where('personil_id', $personil->id)->get();
            
            return view('admin.personil.perlengkapan.index', compact('personil', 'perlengkapan'));
        }

    }

    public function create($nrp)
    {
        $nrpGanti = str_replace('-', '/', $nrp);
        $personil = PersonilModel::where('nrp', $nrpGanti)->first();
        return view('admin.personil.perlengkapan.create', compact('personil'));
    }

    public function store(Request $request, $nrp)
    {
        dd($request);
        // Validasi data yang masuk
        $validatedData = $request->validate([
            'baju' => 'required',
            'celana' => 'required',
            'no_sepatu' => 'required|integer|max:99',
            'no_topi' => 'required|integer|max:99',
            'no_mut' => 'required|integer|max:99',
            'keterangan' => 'nullable|string',
            'personil_id' => 'required',
        ],);

        $nrpGanti = str_replace('-', '/', $nrp);
        $personil = PersonilModel::where('nrp', $nrpGanti)->first();

        if ($personil == null) {
            return abort(404);
        }

        
        // Simpan data pendidikan formal
        $perlengkapan = new PerlengkapanModel([
            'baju' => $validatedData['baju'],
            'celana' => $validatedData['celana'],
            'no_sepatu' => $validatedData['no_sepatu'],
            'no_topi' => $validatedData['no_topi'],
            'no_mut' => $validatedData['no_mut'],
            'keterangan' => $validatedData['keterangan'],
            'personil_id' => $validatedData['personil_id'],
        ]);

        // Hubungkan dengan personil
        $perlengkapan->save();

        return redirect()->route('admin.personil.perlengkapan.index', ['nrp' => $nrp])
            ->with('success', 'Data perlengkapan personil berhasil ditambahkan.');
    }

    public function destroy($nrp, $perlengkapanId)
    {
        $nrpGanti = str_replace('-', '/', $nrp);
        $personil = PersonilModel::where('nrp', $nrpGanti)->first();

        if ($personil == null) {
            return abort(404);
        }

        $perlengkapan = PerlengkapanModel::where('personil_id', $personil->id)
            ->find($perlengkapanId);

        if ($perlengkapan == null) {
            return abort(404);
        }

        // Hapus data perlengkapan
        $perlengkapan->delete();

        return redirect()->route('admin.personil.perlengkapan.index', ['nrp' => $nrp])
            ->with('success', 'Data Perlengkapan personil berhasil dihapus.');
    }

    public function edit($nrp, $perlengkapanId)
    {
        $nrpGanti = str_replace('-', '/', $nrp);
        $personil = PersonilModel::where('nrp', $nrpGanti)->first();

        if ($personil == null) {
            return abort(404);
        }

        $perlengkapan = PerlengkapanModel::where('personil_id', $personil->id)
            ->find($perlengkapanId);

        if ($perlengkapan == null) {
            return abort(404);
        }

        return view('admin.personil.perlengkapan.edit', compact('personil', 'perlengkapan'));
    }
}
