<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
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
        
        $nrpGanti = str_replace('-', '/', $nrp);
        $personil = PersonilModel::where('nrp', $nrpGanti)->first();

        if ($personil == null) {
            return abort(404);
        }
        
        // Validasi data yang masuk
        $validatedData = $request->validate([
            'baju' => 'required',
            'no_sepatu' => 'required|integer|max:99',
            'no_topi' => 'required|integer|max:99',
            'keterangan' => 'nullable|string',
            'personil_id' => 'required',
        ],);
            
        // Simpan data perlengkapan
        $perlengkapan = new PerlengkapanModel([
            'baju' => $validatedData['baju'],
            'celana' => 0,
            'no_sepatu' => $validatedData['no_sepatu'],
            'no_topi' => $validatedData['no_topi'],
            'no_mut' => 0,
            'keterangan' => $validatedData['keterangan'],
            'personil_id' => $validatedData['personil_id'],
        ]);

        if (empty($request->sameValueCelana)) {
            $request->validate([
                'celana' => 'required',
            ]);

            $perlengkapan['celana']=$request->celana;
        } else {
            $perlengkapan['celana'] = $validatedData['baju'];
        }
        
        
        if (empty($request->sameValueMUT)) {
            $request->validate([
                'no_mut' => 'required',
            ]);

            $perlengkapan['no_mut']=$request->no_mut;
        } else {
            $perlengkapan['no_mut'] = $validatedData['no_topi'];
        }
        
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

    public function update(Request $request, $nrp, $perlengkapanId)
    {
        
        $nrpGanti = str_replace('-', '/', $nrp);
        $personil = PersonilModel::where('nrp', $nrpGanti)->first();

        if ($personil == null) {
            return abort(404);
        }

        $perlengkapan = perlengkapanModel::where('personil_id', $personil->id)
            ->find($perlengkapanId);

        if ($perlengkapan == null) {
            return abort(404);
        }
        // Validasi data yang masuk
        $validatedData = $request->validate([
            'baju' => 'required',
            'no_sepatu' => 'required|integer|max:99',
            'no_topi' => 'required|integer|max:99',
            'keterangan' => 'nullable|string',
            'personil_id' => 'required',
        ],);

        // Update data perlengkapan
        $perlengkapan->update([
            'baju' => $validatedData['baju'],
            'celana' => 'S',
            'no_sepatu' => $validatedData['no_sepatu'],
            'no_topi' => $validatedData['no_topi'],
            'no_mut' => 0,
            'keterangan' => $validatedData['keterangan'],
            'personil_id' => $validatedData['personil_id'],
        ]);

        if (empty($request->sameValueCelana)) {
            $request->validate([
                'celana' => 'required',
            ]);

            $perlengkapan->update([
                'celana' => $request->celana,
            ]);
        } else {
            $perlengkapan->update([
                'celana' => $validatedData['baju'],
            ]);
        }
        
        
        if (empty($request->sameValueMUT)) {
            $request->validate([
                'no_mut' => 'required',
            ]);

            $perlengkapan->update([
                'no_mut' => $request->no_mut,
            ]);
        } else {
            $perlengkapan->update([
                'no_mut' => $validatedData['no_topi'],
            ]);
        }

        return redirect()->route('admin.personil.perlengkapan.index', ['nrp' => $nrp])->with('success', 'Data perlengkapan personil berhasil diperbarui.');
    }
}
