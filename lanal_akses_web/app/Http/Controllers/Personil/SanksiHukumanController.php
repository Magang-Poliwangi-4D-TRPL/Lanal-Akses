<?php

namespace App\Http\Controllers\Personil;

use App\Http\Controllers\Controller;
use App\Models\PersonilModel;
use App\Models\SanksiHukumanModel;
use Illuminate\Http\Request;

class SanksiHukumanController extends Controller
{
    public function index($nrp) {
        $nrpGanti = str_replace('-', '/', $nrp);
        $personil = PersonilModel::where('nrp', $nrpGanti)->first();
        
        if($personil == null){
            return redirect()->back()->withErrors(['message' => 'Data personel tidak ditemukan.']);
        } else {
            // Mengambil semua data SanksiHukumanModel yang memiliki personil_id yang sama dengan id PersonilModel yang dicari
            $sanksiHukuman = SanksiHukumanModel::where('personil_id', $personil->id)->get();
            
            return view('personil.sanksi-hukuman.index', compact('personil', 'sanksiHukuman'));
        }

    }

    public function create($nrp)
    {
        $nrpGanti = str_replace('-', '/', $nrp);
        $personil = PersonilModel::where('nrp', $nrpGanti)->first();
        return view('personil.sanksi-hukuman.create', compact('personil'));
    }

    public function store(Request $request, $nrp)
    {
        // Validasi data yang masuk
        $validatedData = $request->validate([
            'nama_hukuman' => 'required|string|max:50',
            'tahun_hukuman' => 'required|digits:4|integer|min:1900|max:'.(date('Y')+1),
            'keterangan' => 'nullable|string',
            'personil_id' => 'required',
        ],);

        $nrpGanti = str_replace('-', '/', $nrp);
        $personil = PersonilModel::where('nrp', $nrpGanti)->first();

        if ($personil == null) {
            return redirect()->back()->withErrors(['message' => 'Data personel tidak ditemukan.']);
        }
        
        // Simpan data sanksi hukuman
        $sanksiHukuman = new sanksiHukumanModel([
            'nama_hukuman' => $validatedData['nama_hukuman'],
            'tahun_hukuman' => $validatedData['tahun_hukuman'],
            'keterangan' => $validatedData['keterangan'],
            'personil_id' => $validatedData['personil_id'],
        ]);

        // Hubungkan dengan personil
        $sanksiHukuman->save();

        return redirect()->route('personel.sanksi-hukuman.index', ['nrp' => $nrp])
            ->with('success', 'Data sanksi hukuman personil berhasil ditambahkan.');
    }

    public function edit($nrp, $sanksiHukumanId)
    {
        $nrpGanti = str_replace('-', '/', $nrp);
        $personil = PersonilModel::where('nrp', $nrpGanti)->first();

        if ($personil == null) {
            return redirect()->back()->withErrors(['message' => 'Data personel tidak ditemukan.']);
        }

        $sanksiHukuman = SanksiHukumanModel::where('personil_id', $personil->id)
            ->find($sanksiHukumanId);

        if ($sanksiHukuman == null) {
            return redirect()->back()->withErrors(['message' => 'Data sanksi hukuman personel tidak ditemukan.']);
        }

        return view('personil.sanksi-hukuman.edit', compact('personil', 'sanksiHukuman'));
    }

    public function update(Request $request, $nrp, $sanksiHukumanId)
    {
        // Validasi data yang masuk
        $validatedData = $request->validate([
            'nama_hukuman' => 'required|string|max:50',
            'tahun_hukuman' => 'required|digits:4|integer|min:1900|max:'.(date('Y')+1),
            'keterangan' => 'nullable|string',
        ],);

        $nrpGanti = str_replace('-', '/', $nrp);
        $personil = PersonilModel::where('nrp', $nrpGanti)->first();

        if ($personil == null) {
            return redirect()->back()->withErrors(['message' => 'Data personel tidak ditemukan.']);
        }

        $sanksiHukuman = sanksiHukumanModel::where('personil_id', $personil->id)
            ->find($sanksiHukumanId);

        if ($sanksiHukuman == null) {
            return redirect()->back()->withErrors(['message' => 'Data sanksi hukuman personel tidak ditemukan.']);
        }

        // Update data sanksi Hukuman
        $sanksiHukuman->update([
            'nama_hukuman' => $validatedData['nama_hukuman'],
            'tahun_hukuman' => $validatedData['tahun_hukuman'],
            'keterangan' => $validatedData['keterangan'],
        ]);

        return redirect()->route('personel.sanksi-hukuman.index', ['nrp' => $nrp])->with('success', 'Data sanksi hukuman personil berhasil diperbarui.');
    }

    public function destroy($nrp, $sanksiHukumanId)
    {
        $nrpGanti = str_replace('-', '/', $nrp);
        $personil = PersonilModel::where('nrp', $nrpGanti)->first();

        if ($personil == null) {
            return redirect()->back()->withErrors(['message' => 'Data personel tidak ditemukan.']);
        }

        $sanksiHukuman = SanksiHukumanModel::where('personil_id', $personil->id)
            ->find($sanksiHukumanId);

        if ($sanksiHukuman == null) {
            return redirect()->back()->withErrors(['message' => 'Data sanksi hukuman personel tidak ditemukan.']);
        }

        // Hapus data sanksi hukuman
        $sanksiHukuman->delete();

        return redirect()->route('personel.sanksi-hukuman.index', ['nrp' => $nrp])
            ->with('success', 'Data sanksi hukuman personil berhasil dihapus.');
    }
}
