<?php

namespace App\Http\Controllers\Personil;

use App\Http\Controllers\Controller;
use App\Models\PendidikanFormalModel;
use App\Models\PersonilModel;
use Illuminate\Http\Request;

class PendidikanFormalController extends Controller
{
    public function index($nrp) {
        $nrpGanti = str_replace('-', '/', $nrp);
        $personil = PersonilModel::where('nrp', $nrpGanti)->first();
        
        if($personil == null){
            return redirect()->back()->withErrors(['message' => 'Data personel tidak ditemukan.']);
        } else {
            // Mengambil semua data PendidikanFormalModel yang memiliki personil_id yang sama dengan id PersonilModel yang dicari
            $pendidikanFormal = PendidikanFormalModel::where('personil_id', $personil->id)->get();
            
            return view('personil.pendidikan-formal.index', compact('personil', 'pendidikanFormal'))->with('success', 'Berhasil menemukan data pendidikan formal personel.');
        }

    }

    public function create($nrp)
    {
        $nrpGanti = str_replace('-', '/', $nrp);
        $personil = PersonilModel::where('nrp', $nrpGanti)->first();
        return view('personil.pendidikan-formal.create', compact('personil'));
    }

    public function store(Request $request, $nrp)
    {
        // Validasi data yang masuk
        $validatedData = $request->validate([
            'nama_pendidikan' => 'required|string|max:50',
            'lama_pendidikan' => 'required|string|max:50',
            'tahun_lulus' => 'required|numeric|regex:/^\d{4}$/',
            'keterangan' => 'nullable|string',
            'personil_id' => 'required',
        ],[
            'tahun_lulus.regex' => 'Format tahun yang anda masukkan salah'
        ]);
        
        $nrpGanti = str_replace('-', '/', $nrp);
        $personil = PersonilModel::where('nrp', $nrpGanti)->first();
        
        if ($personil == null) {
            return redirect()->back()->withErrors(['message' => 'Data personel tidak ditemukan.']);
        }

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

        return redirect()->route('personel.pendidikanformal.index', ['nrp' => $nrp])
            ->with('success', 'Data pendidikan formal berhasil ditambahkan.');
    }

    public function edit($nrp, $pendidikanFormalId)
    {
        $nrpGanti = str_replace('-', '/', $nrp);
        $personil = PersonilModel::where('nrp', $nrpGanti)->first();

        if ($personil == null) {
            return redirect()->back()->withErrors(['message' => 'Data personel tidak ditemukan.']);
        }

        $pendidikanFormal = PendidikanFormalModel::where('personil_id', $personil->id)
            ->find($pendidikanFormalId);

        if ($pendidikanFormal == null) {
            return redirect()->back()->withErrors(['message' => 'Data pendidikan formal personel tidak ditemukan.']);
        }

        return view('personil.pendidikan-formal.edit', compact('personil', 'pendidikanFormal'));
    }

    public function update(Request $request, $nrp, $pendidikanFormalId)
    {
        // Validasi data yang masuk
        $validatedData = $request->validate([
            'nama_pendidikan' => 'required|string|max:50',
            'lama_pendidikan' => 'required|string|max:50',
            'tahun_lulus' => 'required|numeric|regex:/^\d{4}$/',
            'keterangan' => 'nullable|string',
        ],[
            'tahun_lulus.regex' => 'Format tahun yang anda masukkan salah'
        ]);

        $nrpGanti = str_replace('-', '/', $nrp);
        $personil = PersonilModel::where('nrp', $nrpGanti)->first();

        if ($personil == null) {
            return redirect()->back()->withErrors(['message' => 'Data personel tidak ditemukan.']);
        }

        $pendidikanFormal = PendidikanFormalModel::where('personil_id', $personil->id)
            ->find($pendidikanFormalId);

        if ($pendidikanFormal == null) {
            return redirect()->back()->withErrors(['message' => 'Data pendidikan formal personel tidak ditemukan.']);
        }

        // Update data PendidikanFormal
        $pendidikanFormal->update([
            'nama_pendidikan' => $validatedData['nama_pendidikan'],
            'lama_pendidikan' => $validatedData['lama_pendidikan'],
            'tahun_lulus' => $validatedData['tahun_lulus'],
            'keterangan' => $validatedData['keterangan'],
        ]);

        return redirect()->route('personel.pendidikanformal.index', ['nrp' => $nrp])->with('success', 'Data Pendidikan Formal berhasil diperbarui.');
    }


    public function destroy($nrp, $pendidikanFormalId)
    {
        $nrpGanti = str_replace('-', '/', $nrp);
        $personil = PersonilModel::where('nrp', $nrpGanti)->first();

        if ($personil == null) {
            return redirect()->back()->withErrors(['message' => 'Data personel tidak ditemukan.']);
        }

        $pendidikanFormal = PendidikanFormalModel::where('personil_id', $personil->id)
            ->find($pendidikanFormalId);

        if ($pendidikanFormal == null) {
            return redirect()->back()->withErrors(['message' => 'Data pendidikan personel tidak ditemukan.']);
        }

        // Hapus data PendidikanFormal
        $pendidikanFormal->delete();

        return redirect()->route('personel.pendidikanformal.index', ['nrp' => $nrp])
            ->with('success', 'Data Pendidikan Formal berhasil dihapus.');
    }
}
