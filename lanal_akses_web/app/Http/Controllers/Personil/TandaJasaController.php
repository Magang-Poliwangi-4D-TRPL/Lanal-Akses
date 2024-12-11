<?php

namespace App\Http\Controllers\Personil;

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
            return redirect()->back()->withErrors(['message' => 'Data personel tidak ditemukan.']);
        } else {
            // Mengambil semua TandaJasaModel yang memiliki personil_id yang sama dengan id PersonilModel yang dicari
            $tandaJasa = TandaJasaModel::where('personil_id', $personil->id)->get();
            
            return view('personil.tanda-jasa.index', compact('personil', 'tandaJasa'));
        }

    }

    public function create($nrp)
    {
        $nrpGanti = str_replace('-', '/', $nrp);
        $personil = PersonilModel::where('nrp', $nrpGanti)->first();
        return view('personil.tanda-jasa.create', compact('personil'));
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
            return redirect()->back()->withErrors(['message' => 'Data personel tidak ditemukan.']);
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

        return redirect()->route('personel.tanda-jasa.index', ['nrp' => $nrp])
            ->with('success', 'Data tanda jasa personel berhasil ditambahkan.');
    }

    public function edit($nrp, $tandaJasaId)
    {
        $nrpGanti = str_replace('-', '/', $nrp);
        $personil = PersonilModel::where('nrp', $nrpGanti)->first();

        if ($personil == null) {
            return redirect()->back()->withErrors(['message' => 'Data personel tidak ditemukan.']);
        }

        $tandaJasa = TandaJasaModel::where('personil_id', $personil->id)
            ->find($tandaJasaId);

        if ($tandaJasa == null) {
            return redirect()->back()->withErrors(['message' => 'Data tanda jasa personel tidak ditemukan.']);
        }

        return view('personil.tanda-jasa.edit', compact('personil', 'tandaJasa'));
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
            return redirect()->back()->withErrors(['message' => 'Data personel tidak ditemukan.']);
        }

        $tandaJasa = tandaJasaModel::where('personil_id', $personil->id)
            ->find($tandaJasaId);

        if ($tandaJasa == null) {
            return redirect()->back()->withErrors(['message' => 'Data tanda jasa personel tidak ditemukan.']);
        }

        // Update data tandaJasa
        $tandaJasa->update([
            'nama_tanda_jasa' => $validatedData['nama_tanda_jasa'],
            'no_skep' => $validatedData['no_skep'],
            'keterangan' => $validatedData['keterangan'],
            'personil_id' => $validatedData['personil_id'],
        ]);

        return redirect()->route('personel.tanda-jasa.index', ['nrp' => $nrp])->with('success', 'Data tanda jasa personil berhasil diperbarui.');
    }

    public function destroy($nrp, $tandaJasaId)
    {
        $nrpGanti = str_replace('-', '/', $nrp);
        $personil = PersonilModel::where('nrp', $nrpGanti)->first();

        if ($personil == null) {
            return redirect()->back()->withErrors(['message' => 'Data personel tidak ditemukan.']);
        }

        $tandaJasa = TandaJasaModel::where('personil_id', $personil->id)
            ->find($tandaJasaId);

        if ($tandaJasa == null) {
            return redirect()->back()->withErrors(['message' => 'Data tanda jasa personel tidak ditemukan.']);
        }

        // Hapus data tandaJasa
        $tandaJasa->delete();

        return redirect()->route('personel.tanda-jasa.index', ['nrp' => $nrp])
            ->with('success', 'Data tanda jasa personil berhasil dihapus.');
    }
}
