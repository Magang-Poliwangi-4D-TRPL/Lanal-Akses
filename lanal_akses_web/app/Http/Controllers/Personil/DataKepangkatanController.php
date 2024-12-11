<?php

namespace App\Http\Controllers\Personil;

use App\Http\Controllers\Controller;
use App\Models\DataKepangkatanModel;
use App\Models\PersonilModel;
use Illuminate\Http\Request;

class DataKepangkatanController extends Controller
{
    public function index($nrp) {
        $nrpGanti = str_replace('-', '/', $nrp);
        $personil = PersonilModel::where('nrp', $nrpGanti)->first();
        
        if($personil == null){
            return redirect()->back()->withErrors(['message' => 'Data personel tidak ditemukan.']);
        } else {
            // Mengambil semua data DataKepangkatanModel yang memiliki personil_id yang sama dengan id PersonilModel yang dicari
            $dataKepangkatan = DataKepangkatanModel::where('personil_id', $personil->id)->get();
            
            return view('personil.data-kepangkatan.index', compact('personil', 'dataKepangkatan'));
        }

    }

    public function create($nrp)
    {
        $nrpGanti = str_replace('-', '/', $nrp);
        $personil = PersonilModel::where('nrp', $nrpGanti)->first();
        return view('personil.data-kepangkatan.create', compact('personil'));
    }

    public function store(Request $request, $nrp)
    {
        // Validasi data yang masuk
        $validatedData = $request->validate([
            'pangkat' => 'required|string|max:50',
            'no_skep' => 'required|string|max:50',
            'tempat_pangkat' => 'required|string|max:50',
            'keterangan' => 'nullable|string',
            'personil_id' => 'required',
        ],);

        $nrpGanti = str_replace('-', '/', $nrp);
        $personil = PersonilModel::where('nrp', $nrpGanti)->first();

        if ($personil == null) {
            return redirect()->back()->withErrors(['message' => 'Data personel tidak ditemukan.']);
        }
        
        // Simpan data kepangkatan
        $kepangkatan = new DataKepangkatanModel([
            'pangkat' => $validatedData['pangkat'],
            'no_skep' => $validatedData['no_skep'],
            'tempat_pangkat' => $validatedData['tempat_pangkat'],
            'keterangan' => $validatedData['keterangan'],
            'personil_id' => $validatedData['personil_id'],
        ]);

        // Hubungkan dengan personil
        $kepangkatan->save();

        return redirect()->route('personel.data-kepangkatan.index', ['nrp' => $nrp])
            ->with('success', 'Data kepangkatan personil berhasil ditambahkan.');
    }

    public function edit($nrp, $dataKepangkatanId)
    {
        $nrpGanti = str_replace('-', '/', $nrp);
        $personil = PersonilModel::where('nrp', $nrpGanti)->first();

        if ($personil == null) {
            return redirect()->back()->withErrors(['message' => 'Data personel tidak ditemukan.']);
        }

        $dataKepangkatan = DataKepangkatanModel::where('personil_id', $personil->id)
            ->find($dataKepangkatanId);

        if ($dataKepangkatan == null) {
            return redirect()->back()->withErrors(['message' => 'Data kepangkatan personel tidak ditemukan.']);
        }

        return view('personil.data-kepangkatan.edit', compact('personil', 'dataKepangkatan'));
    }

    public function update(Request $request, $nrp, $dataKepangkatanId)
    {
        // Validasi data yang masuk
        $validatedData = $request->validate([
            'pangkat' => 'required|string|max:50',
            'no_skep' => 'required|string|max:50',
            'tempat_pangkat' => 'required|string|max:50',
            'keterangan' => 'nullable|string',
        ],);

        $nrpGanti = str_replace('-', '/', $nrp);
        $personil = PersonilModel::where('nrp', $nrpGanti)->first();

        if ($personil == null) {
            return redirect()->back()->withErrors(['message' => 'Data personel tidak ditemukan.']);
        }

        $kepangkatan = DataKepangkatanModel::where('personil_id', $personil->id)
            ->find($dataKepangkatanId);

        if ($kepangkatan == null) {
            return redirect()->back()->withErrors(['message' => 'Data kepangkatan personel tidak ditemukan.']);
        }

        // Update data kepangkatan
        $kepangkatan->update([
            'pangkat' => $validatedData['pangkat'],
            'no_skep' => $validatedData['no_skep'],
            'tempat_pangkat' => $validatedData['tempat_pangkat'],
            'keterangan' => $validatedData['keterangan'],
        ]);

        return redirect()->route('personel.data-kepangkatan.index', ['nrp' => $nrp])->with('success', 'Data kepangkatan personil berhasil diperbarui.');
    }

    public function destroy($nrp, $dataKepangkatanId)
    {
        $nrpGanti = str_replace('-', '/', $nrp);
        $personil = PersonilModel::where('nrp', $nrpGanti)->first();

        if ($personil == null) {
            return redirect()->back()->withErrors(['message' => 'Data personel tidak ditemukan.']);
        }

        $kepangkatan = DataKepangkatanModel::where('personil_id', $personil->id)
            ->find($dataKepangkatanId);

        if ($kepangkatan == null) {
            return redirect()->back()->withErrors(['message' => 'Data kepangkatan personel tidak ditemukan.']);
        }

        // Hapus data kepangkatan
        $kepangkatan->delete();

        return redirect()->route('personel.data-kepangkatan.index', ['nrp' => $nrp])
            ->with('success', 'Data Kepangkatan personel berhasil dihapus.');
    }
}
