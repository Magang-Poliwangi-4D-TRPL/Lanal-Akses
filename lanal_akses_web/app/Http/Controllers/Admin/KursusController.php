<?php

namespace App\Http\Controllers\Admin;

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
            return abort(404);
        } else {
            // Mengambil semua data KursusModel yang memiliki personil_id yang sama dengan id PersonilModel yang dicari
            $kursus = KursusModel::where('personil_id', $personil->id)->get();
            
            return view('admin.personil.kursus.index', compact('personil', 'kursus'));
        }

    }

    public function create($nrp)
    {
        $nrpGanti = str_replace('-', '/', $nrp);
        $personil = PersonilModel::where('nrp', $nrpGanti)->first();
        return view('admin.personil.kursus.create', compact('personil'));
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
            return abort(404);
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

        return redirect()->route('admin.personil.kursus.index', ['nrp' => $nrp])
            ->with('success', 'Data kursus personil berhasil ditambahkan.');
    }

    public function edit($nrp, $kursusId)
    {
        $nrpGanti = str_replace('-', '/', $nrp);
        $personil = PersonilModel::where('nrp', $nrpGanti)->first();

        if ($personil == null) {
            return abort(404);
        }

        $kursus = KursusModel::where('personil_id', $personil->id)
            ->find($kursusId);

        if ($kursus == null) {
            return abort(404);
        }

        return view('admin.personil.kursus.edit', compact('personil', 'kursus'));
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
            return abort(404);
        }

        $kursus = KursusModel::where('personil_id', $personil->id)
            ->find($kursusId);

        if ($kursus == null) {
            return abort(404);
        }

        // Update data kursus
        $kursus->update([
            'nama_kursus' => $validatedData['nama_kursus'],
            'lama_kursus' => $validatedData['lama_kursus'],
            'tempat_kursus' => $validatedData['tempat_kursus'],
            'keterangan' => $validatedData['keterangan'],
        ]);

        return redirect()->route('admin.personil.kursus.index', ['nrp' => $nrp])->with('success', 'Data kursus personil berhasil diperbarui.');
    }

    public function destroy($nrp, $kursusId)
    {
        $nrpGanti = str_replace('-', '/', $nrp);
        $personil = PersonilModel::where('nrp', $nrpGanti)->first();

        if ($personil == null) {
            return abort(404);
        }

        $kursus = kursusModel::where('personil_id', $personil->id)
            ->find($kursusId);

        if ($kursus == null) {
            return abort(404);
        }

        // Hapus data kursus
        $kursus->delete();

        return redirect()->route('admin.personil.kursus.index', ['nrp' => $nrp])
            ->with('success', 'Data kursus personil berhasil dihapus.');
    }
}
