<?php

namespace App\Http\Controllers\Personil;

use App\Http\Controllers\Controller;
use App\Models\KursusModel;
use App\Models\PersonilModel;
use Illuminate\Http\Request;

class KursusController extends Controller
{
    public function index($nrp) {
        $nrpGanti = str_replace('-', '/', $nrp);
        $personil = PersonilModel::where('nrp', $nrpGanti)->first();
        
        if($personil == null){
            return redirect()->back()->withErrors(['message' => 'Data personel tidak ditemukan.']);
        } else {
            // Mengambil semua data KursusModel yang memiliki personil_id yang sama dengan id PersonilModel yang dicari
            $kursus = KursusModel::where('personil_id', $personil->id)->get();
            
            return view('personil.kursus.index', compact('personil', 'kursus'));
        }

    }

    public function create($nrp)
    {
        $nrpGanti = str_replace('-', '/', $nrp);
        $personil = PersonilModel::where('nrp', $nrpGanti)->first();
        return view('personil.kursus.create', compact('personil'));
    }

    public function store(Request $request, $nrp)
    {
        // Validasi data yang masuk
        $validatedData = $request->validate([
            'nama_kursus' => 'required|string|max:50',
            'lama_kursus' => 'required|string|max:50',
            'tempat_kursus' => 'required|string|max:50',
            'keterangan' => 'nullable|string',
            'personil_id' => 'required',
        ],);

        $nrpGanti = str_replace('-', '/', $nrp);
        $personil = PersonilModel::where('nrp', $nrpGanti)->first();

        if ($personil == null) {
            return redirect()->back()->withErrors(['message' => 'Data personel tidak ditemukan.']);
        }
        
        // Simpan data pendidikan formal
        $kursus = new KursusModel([
            'nama_kursus' => $validatedData['nama_kursus'],
            'lama_kursus' => $validatedData['lama_kursus'],
            'tempat_kursus' => $validatedData['tempat_kursus'],
            'keterangan' => $validatedData['keterangan'],
            'personil_id' => $validatedData['personil_id'],
        ]);

        // Hubungkan dengan personil
        $kursus->save();

        return redirect()->route('personel.kursus.index', ['nrp' => $nrp])
            ->with('success', 'Data kursus personil berhasil ditambahkan.');
    }

    public function edit($nrp, $kursusId)
    {
        $nrpGanti = str_replace('-', '/', $nrp);
        $personil = PersonilModel::where('nrp', $nrpGanti)->first();

        if ($personil == null) {
            return redirect()->back()->withErrors(['message' => 'Data personel tidak ditemukan.']);
        }

        $kursus = KursusModel::where('personil_id', $personil->id)
            ->find($kursusId);

        if ($kursus == null) {
            return redirect()->back()->withErrors(['message' => 'Data kursus personel tidak ditemukan.']);
        }

        return view('personil.kursus.edit', compact('personil', 'kursus'));
    }

    public function update(Request $request, $nrp, $kursusId)
    {
        // Validasi data yang masuk
        $validatedData = $request->validate([
            'nama_kursus' => 'required|string|max:50',
            'lama_kursus' => 'required|string|max:50',
            'tempat_kursus' => 'required|string|max:50',
            'keterangan' => 'nullable|string',
            'personil_id' => 'required',
        ],);

        $nrpGanti = str_replace('-', '/', $nrp);
        $personil = PersonilModel::where('nrp', $nrpGanti)->first();

        if ($personil == null) {
            return redirect()->back()->withErrors(['message' => 'Data personel tidak ditemukan.']);
        }

        $kursus = KursusModel::where('personil_id', $personil->id)
            ->find($kursusId);

        if ($kursus == null) {
            return redirect()->back()->withErrors(['message' => 'Data kursus personel tidak ditemukan.']);
        }

        // Update data kursus
        $kursus->update([
            'nama_kursus' => $validatedData['nama_kursus'],
            'lama_kursus' => $validatedData['lama_kursus'],
            'tempat_kursus' => $validatedData['tempat_kursus'],
            'keterangan' => $validatedData['keterangan'],
        ]);

        return redirect()->route('personel.kursus.index', ['nrp' => $nrp])->with('success', 'Data kursus personil berhasil diperbarui.');
    }

    public function destroy($nrp, $kursusId)
    {
        $nrpGanti = str_replace('-', '/', $nrp);
        $personil = PersonilModel::where('nrp', $nrpGanti)->first();

        if ($personil == null) {
            return redirect()->back()->withErrors(['message' => 'Data personel tidak ditemukan.']);
        }

        $kursus = kursusModel::where('personil_id', $personil->id)
            ->find($kursusId);

        if ($kursus == null) {
            return redirect()->back()->withErrors(['message' => 'Data kursus personel tidak ditemukan.']);
        }

        // Hapus data kursus
        $kursus->delete();

        return redirect()->route('personel.kursus.index', ['nrp' => $nrp])
            ->with('success', 'Data kursus personil berhasil dihapus.');
    }
}
