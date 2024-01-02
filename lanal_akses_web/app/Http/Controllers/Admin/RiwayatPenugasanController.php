<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PersonilModel;
use App\Models\RiwayatPenugasanModel;
use Illuminate\Http\Request;

class RiwayatPenugasanController extends Controller
{
    public function index($nrp) {
        $nrpGanti = str_replace('-', '/', $nrp);
        $personil = PersonilModel::where('nrp', $nrpGanti)->first();
        
        if($personil == null){
            return abort(404);
        } else {
            // Mengambil semua data RiwayatPenugasanModel yang memiliki personil_id yang sama dengan id PersonilModel yang dicari
            $riwayatPenugasan = RiwayatPenugasanModel::where('personil_id', $personil->id)->get();
            
            return view('admin.personil.riwayat-penugasan.index', compact('personil', 'riwayatPenugasan'));
        }

    }

    public function create($nrp)
    {
        $nrpGanti = str_replace('-', '/', $nrp);
        $personil = PersonilModel::where('nrp', $nrpGanti)->first();
        return view('admin.personil.riwayat-penugasan.create', compact('personil'));
    }

    public function store(Request $request, $nrp)
    {
        // Validasi data yang masuk
        $validatedData = $request->validate([
            'tahun' => 'required|digits:4|integer|min:1900|max:'.(date('Y')+1),
            'jabatan' => 'required|string|max:50',
            'tempat' => 'required|string|max:50',
            'keterangan' => 'nullable|string',
            'personil_id' => 'required',
        ],);

        $nrpGanti = str_replace('-', '/', $nrp);
        $personil = PersonilModel::where('nrp', $nrpGanti)->first();

        if ($personil == null) {
            return abort(404);
        }
        
        // Simpan data Riwayat Penugasan
        $riwayatPenugasan = new riwayatPenugasanModel([
            'tahun' => $validatedData['tahun'],
            'jabatan' => $validatedData['jabatan'],
            'tempat' => $validatedData['tempat'],
            'keterangan' => $validatedData['keterangan'],
            'personil_id' => $validatedData['personil_id'],
        ]);

        // Hubungkan dengan personil
        $riwayatPenugasan->save();

        return redirect()->route('admin.personil.riwayat-penugasan.index', ['nrp' => $nrp])
            ->with('success', 'Data riwayat penugasan personil berhasil ditambahkan.');
    }

    public function edit($nrp, $riwayatPenugasanId)
    {
        $nrpGanti = str_replace('-', '/', $nrp);
        $personil = PersonilModel::where('nrp', $nrpGanti)->first();

        if ($personil == null) {
            return abort(404);
        }

        $riwayatPenugasan = RiwayatPenugasanModel::where('personil_id', $personil->id)
            ->find($riwayatPenugasanId);

        if ($riwayatPenugasan == null) {
            return abort(404);
        }

        return view('admin.personil.riwayat-penugasan.edit', compact('personil', 'riwayatPenugasan'));
    }

    public function update(Request $request, $nrp, $riwayatPenugasanId)
    {
        // Validasi data yang masuk
        $validatedData = $request->validate([
            'tahun' => 'required|digits:4|integer|min:1900|max:'.(date('Y')+1),
            'jabatan' => 'required|string|max:50',
            'tempat' => 'required|string|max:50',
            'keterangan' => 'nullable|string',
        ],);

        $nrpGanti = str_replace('-', '/', $nrp);
        $personil = PersonilModel::where('nrp', $nrpGanti)->first();

        if ($personil == null) {
            return abort(404);
        }

        $riwayatPenugasan = riwayatPenugasanModel::where('personil_id', $personil->id)
            ->find($riwayatPenugasanId);

        if ($riwayatPenugasan == null) {
            return abort(404);
        }

        // Update data riwayatPenugasan
        $riwayatPenugasan->update([
            'tahun' => $validatedData['tahun'],
            'jabatan' => $validatedData['jabatan'],
            'tempat' => $validatedData['tempat'],
            'keterangan' => $validatedData['keterangan'],
        ]);

        return redirect()->route('admin.personil.riwayat-penugasan.index', ['nrp' => $nrp])->with('success', 'Data riwayat penugasan personil berhasil diperbarui.');
    }

    public function destroy($nrp, $riwayatPenugasanId)
    {
        $nrpGanti = str_replace('-', '/', $nrp);
        $personil = PersonilModel::where('nrp', $nrpGanti)->first();

        if ($personil == null) {
            return abort(404);
        }

        $riwayatPenugasan = riwayatPenugasanModel::where('personil_id', $personil->id)
            ->find($riwayatPenugasanId);

        if ($riwayatPenugasan == null) {
            return abort(404);
        }

        // Hapus data riwayatPenugasan
        $riwayatPenugasan->delete();

        return redirect()->route('admin.personil.riwayat-penugasan.index', ['nrp' => $nrp])
            ->with('success', 'Data riwayat penugasan personil berhasil dihapus.');
    }
}
