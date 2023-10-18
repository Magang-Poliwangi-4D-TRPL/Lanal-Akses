<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PendidikanMiliterModel;
use App\Models\PersonilModel;
use Illuminate\Http\Request;

class PendidikanMiliterController extends Controller
{
    public function index($nrp) {
        $nrpGanti = str_replace('-', '/', $nrp);
        $personil = PersonilModel::where('nrp', $nrpGanti)->first();
        
        if($personil == null){
            return abort(404);
        } else {
            // Mengambil semua data PendidikanMiliterModel yang memiliki personil_id yang sama dengan id PersonilModel yang dicari
            $pendidikanMiliter = PendidikanMiliterModel::where('personil_id', $personil->id)->get();
            
            return view('admin.personil.pendidikan-militer.index', compact('personil', 'pendidikanMiliter'));
        }

    }

    public function create($nrp)
    {
        $nrpGanti = str_replace('-', '/', $nrp);
        $personil = PersonilModel::where('nrp', $nrpGanti)->first();
        return view('admin.personil.pendidikan-militer.create', compact('personil'));
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
        
        // Simpan data pendidikan formal
        $pendidikanMiliter = new PendidikanMiliterModel([
            'nama_pendidikan' => $validatedData['nama_pendidikan'],
            'lama_pendidikan' => $validatedData['lama_pendidikan'],
            'tahun_lulus' => $validatedData['tahun_lulus'],
            'keterangan' => $validatedData['keterangan'],
            'personil_id' => $validatedData['personil_id'],
        ]);

        // Hubungkan dengan personil
        $pendidikanMiliter->save();

        return redirect()->route('admin.personil.pendidikanmiliter.index', ['nrp' => $nrp])
            ->with('success', 'Data pendidikan militer berhasil ditambahkan.');
    }

    public function edit($nrp, $pendidikanMiliterId)
    {
        $nrpGanti = str_replace('-', '/', $nrp);
        $personil = PersonilModel::where('nrp', $nrpGanti)->first();

        if ($personil == null) {
            return abort(404);
        }

        $pendidikanMiliter = PendidikanMiliterModel::where('personil_id', $personil->id)
            ->find($pendidikanMiliterId);

        if ($pendidikanMiliter == null) {
            return abort(404);
        }

        return view('admin.personil.pendidikan-militer.edit', compact('personil', 'pendidikanMiliter'));
    }

    public function update(Request $request, $nrp, $pendidikanMiliterId)
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
            return abort(404);
        }

        $pendidikanMilter = PendidikanMiliterModel::where('personil_id', $personil->id)
            ->find($pendidikanMiliterId);

        if ($pendidikanMilter == null) {
            return abort(404);
        }

        // Update data pendidikanMilter
        $pendidikanMilter->update([
            'nama_pendidikan' => $validatedData['nama_pendidikan'],
            'lama_pendidikan' => $validatedData['lama_pendidikan'],
            'tahun_lulus' => $validatedData['tahun_lulus'],
            'keterangan' => $validatedData['keterangan'],
        ]);

        return redirect()->route('admin.personil.pendidikanmiliter.index', ['nrp' => $nrp])->with('success', 'Data Pendidikan Militer berhasil diperbarui.');
    }

    public function destroy($nrp, $pendidikanMiliterId)
    {
        $nrpGanti = str_replace('-', '/', $nrp);
        $personil = PersonilModel::where('nrp', $nrpGanti)->first();

        if ($personil == null) {
            return abort(404);
        }

        $pendidikanMiliter = PendidikanMiliterModel::where('personil_id', $personil->id)
            ->find($pendidikanMiliterId);

        if ($pendidikanMiliter == null) {
            return abort(404);
        }

        // Hapus data PendidikanMiliter
        $pendidikanMiliter->delete();

        return redirect()->route('admin.personil.pendidikanmiliter.index', ['nrp' => $nrp])
            ->with('success', 'Data Pendidikan Militer berhasil dihapus.');
    }
}
