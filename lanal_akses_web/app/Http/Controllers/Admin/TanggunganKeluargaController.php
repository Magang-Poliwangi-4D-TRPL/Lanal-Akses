<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PersonilModel;
use App\Models\TanggunganKeluargaModel;
use Illuminate\Http\Request;

class TanggunganKeluargaController extends Controller
{
    public function index($nrp) {
        $nrpGanti = str_replace('-', '/', $nrp);
        $personil = PersonilModel::where('nrp', $nrpGanti)->first();
        
        if($personil == null){
            return abort(404);
        } else {
            // Mengambil semua data TanggunganKeluargaModel yang memiliki personil_id yang sama dengan id PersonilModel yang dicari
            $tanggunganKeluarga = TanggunganKeluargaModel::where('personil_id', $personil->id)->get();
            
            return view('admin.personil.tanggungan-keluarga.index', compact('personil', 'tanggunganKeluarga'));
        }

    }

    public function create($nrp)
    {
        $nrpGanti = str_replace('-', '/', $nrp);
        $personil = PersonilModel::where('nrp', $nrpGanti)->first();
        return view('admin.personil.tanggungan-keluarga.create', compact('personil'));
    }

    public function store(Request $request, $nrp)
    {
        // Validasi data yang masuk
        $validatedData = $request->validate([
            'nama_lengkap' => 'required|string|max:25',
            'tempat_lahir' => 'required|string|max:50',
            'tanggal_lahir' => 'required|string|max:50',
            'status_hubungan' => 'required',
            'jenis_kelamin' => 'nullable',
            'keterangan' => 'nullable|string',
            'personil_id' => 'required',
        ],);

        $nrpGanti = str_replace('-', '/', $nrp);
        $personil = PersonilModel::where('nrp', $nrpGanti)->first();

        if ($personil == null) {
            return abort(404);
        }
        
        // Simpan data pendidikan formal
        $tanggunganKeluaraga = new TanggunganKeluargaModel([
            'nama_lengkap' => $validatedData['nama_lengkap'],
            'tempat_lahir' => $validatedData['tempat_lahir'],
            'tanggal_lahir' => $validatedData['tanggal_lahir'],
            'status_hubungan' => $validatedData['status_hubungan'],
            'keterangan' => $validatedData['keterangan'],
            'personil_id' => $validatedData['personil_id'],
        ]);

        if ($request->status_hubungan == 'Suami') {
            $tanggunganKeluaraga->jenis_kelamin = 'L';
        } elseif ($request->status_hubungan == 'Istri') {
            $tanggunganKeluaraga->jenis_kelamin = 'P';
        } else {
            $tanggunganKeluaraga->jenis_kelamin = $request->jenis_kelamin;
        }

        // Hubungkan dengan personil
        $tanggunganKeluaraga->save();

        return redirect()->route('admin.personil.tanggungan-keluarga.index', ['nrp' => $nrp])
            ->with('success', 'Data tanggungan keluarga personil berhasil ditambahkan.');
    }

    public function edit($nrp, $tanggunganKeluaragaId)
    {
        $nrpGanti = str_replace('-', '/', $nrp);
        $personil = PersonilModel::where('nrp', $nrpGanti)->first();

        if ($personil == null) {
            return abort(404);
        }

        $tanggunganKeluarga = TanggunganKeluargaModel::where('personil_id', $personil->id)
            ->find($tanggunganKeluaragaId);

        if ($tanggunganKeluarga == null) {
            return abort(404);
        }

        return view('admin.personil.tanggungan-keluarga.edit', compact('personil', 'tanggunganKeluarga'));
    }

    public function update(Request $request, $nrp, $tanggunganKeluaragaId)
    {
        // Validasi data yang masuk
        $validatedData = $request->validate([
            'nama_lengkap' => 'required|string|max:25',
            'tempat_lahir' => 'required|string|max:50',
            'tanggal_lahir' => 'required|string|max:50',
            'status_hubungan' => 'required',
            'jenis_kelamin' => 'nullable',
            'keterangan' => 'nullable|string',
        ],);

        $nrpGanti = str_replace('-', '/', $nrp);
        $personil = PersonilModel::where('nrp', $nrpGanti)->first();

        if ($personil == null) {
            return abort(404);
        }

        $tanggunganKeluarga = TanggunganKeluargaModel::where('personil_id', $personil->id)
            ->find($tanggunganKeluaragaId);

        if ($tanggunganKeluarga == null) {
            return abort(404);
        }

        if ($request->status_hubungan == 'Suami') {
            $tanggunganKeluarga->update([
                'jenis_kelamin' => 'L',
            ]);
        } elseif ($request->status_hubungan == 'Istri') {
            $tanggunganKeluarga->update([
                'jenis_kelamin' => 'P',
            ]);
        } else {
            $tanggunganKeluarga->update([
                'jenis_kelamin' => $request['jenis_kelamin'],
            ]);
        }

        // Update data tanggunganKeluarga
        $tanggunganKeluarga->update([
            'nama_lengkap' => $validatedData['nama_lengkap'],
            'tempat_lahir' => $validatedData['tempat_lahir'],
            'tanggal_lahir' => $validatedData['tanggal_lahir'],
            'status_hubungan' => $validatedData['status_hubungan'],
            'keterangan' => $validatedData['keterangan'],
        ]);

        return redirect()->route('admin.personil.tanggungan-keluarga.index', ['nrp' => $nrp])->with('success', 'Data tanggungan keluarga personil berhasil diperbarui.');
    }

    public function destroy($nrp, $tanggunganKeluargaId)
    {
        $nrpGanti = str_replace('-', '/', $nrp);
        $personil = PersonilModel::where('nrp', $nrpGanti)->first();

        if ($personil == null) {
            return abort(404);
        }

        $tanggunganKeluarga = TanggunganKeluargaModel::where('personil_id', $personil->id)
            ->find($tanggunganKeluargaId);

        if ($tanggunganKeluarga == null) {
            return abort(404);
        }

        // Hapus data TanggunganKeluarga
        $tanggunganKeluarga->delete();

        return redirect()->route('admin.personil.tanggungan-keluarga.index', ['nrp' => $nrp])
            ->with('success', 'Data tanggungan keluarga berhasil dihapus.');
    }
}
