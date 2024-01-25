<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PersonilModel;
use App\Models\TandaJasaModel;
use Illuminate\Http\Request;

class TandaJasaController extends Controller
{
    public function index($nrp) {
        $nrpGanti = str_replace('-', '/', $nrp);
        $personil = PersonilModel::where('nrp', $nrpGanti)->first();
        
        if($personil == null){
            return abort(404);
        } else {
            // Mengambil semua TandaJasaModel yang memiliki personil_id yang sama dengan id PersonilModel yang dicari
            $tandaJasa = TandaJasaModel::where('personil_id', $personil->id)->get();
            
            return view('admin.personil.tanda-jasa.index', compact('personil', 'tandaJasa'));
        }

    }

    public function create($nrp)
    {
        $nrpGanti = str_replace('-', '/', $nrp);
        $personil = PersonilModel::where('nrp', $nrpGanti)->first();
        return view('admin.personil.tanda-jasa.create', compact('personil'));
    }

    public function store(Request $request, $nrp)
    {
        // Validasi data yang masuk
        $validatedData = $request->validate([
            'nama_tanda_jasa' => 'required|string|max:50',
            'no_skep' => 'required|string|max:50',
            'keterangan' => 'nullable|string',
            'personil_id' => 'required',
        ],);

        $nrpGanti = str_replace('-', '/', $nrp);
        $personil = PersonilModel::where('nrp', $nrpGanti)->first();

        if ($personil == null) {
            return abort(404);
        }
        
        // Simpan data pendidikan formal
        $tandaJasa = new tandaJasaModel([
            'nama_tanda_jasa' => $validatedData['nama_tanda_jasa'],
            'no_skep' => $validatedData['no_skep'],
            'keterangan' => $validatedData['keterangan'],
            'personil_id' => $validatedData['personil_id'],
        ]);

        // Hubungkan dengan personil
        $tandaJasa->save();

        return redirect()->route('admin.personil.tanda-jasa.index', ['nrp' => $nrp])
            ->with('success', 'Data tanda jasa personel berhasil ditambahkan.');
    }

    public function edit($nrp, $tandaJasaId)
    {
        $nrpGanti = str_replace('-', '/', $nrp);
        $personil = PersonilModel::where('nrp', $nrpGanti)->first();

        if ($personil == null) {
            return abort(404);
        }

        $tandaJasa = TandaJasaModel::where('personil_id', $personil->id)
            ->find($tandaJasaId);

        if ($tandaJasa == null) {
            return abort(404);
        }

        return view('admin.personil.tanda-jasa.edit', compact('personil', 'tandaJasa'));
    }

    public function update(Request $request, $nrp, $tandaJasaId)
    {
        // Validasi data yang masuk
        $validatedData = $request->validate([
            'nama_tanda_jasa' => 'required|string|max:50',
            'no_skep' => 'required|string|max:50',
            'keterangan' => 'nullable|string',
            'personil_id' => 'required',
        ],);

        $nrpGanti = str_replace('-', '/', $nrp);
        $personil = PersonilModel::where('nrp', $nrpGanti)->first();

        if ($personil == null) {
            return abort(404);
        }

        $tandaJasa = tandaJasaModel::where('personil_id', $personil->id)
            ->find($tandaJasaId);

        if ($tandaJasa == null) {
            return abort(404);
        }

        // Update data tandaJasa
        $tandaJasa->update([
            'nama_tanda_jasa' => $validatedData['nama_tanda_jasa'],
            'no_skep' => $validatedData['no_skep'],
            'keterangan' => $validatedData['keterangan'],
            'personil_id' => $validatedData['personil_id'],
        ]);

        return redirect()->route('admin.personil.tanda-jasa.index', ['nrp' => $nrp])->with('success', 'Data tanda jasa personil berhasil diperbarui.');
    }

    public function destroy($nrp, $tandaJasaId)
    {
        $nrpGanti = str_replace('-', '/', $nrp);
        $personil = PersonilModel::where('nrp', $nrpGanti)->first();

        if ($personil == null) {
            return abort(404);
        }

        $tandaJasa = TandaJasaModel::where('personil_id', $personil->id)
            ->find($tandaJasaId);

        if ($tandaJasa == null) {
            return abort(404);
        }

        // Hapus data tandaJasa
        $tandaJasa->delete();

        return redirect()->route('admin.personil.tanda-jasa.index', ['nrp' => $nrp])
            ->with('success', 'Data tanda jasa personil berhasil dihapus.');
    }
}
