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
            $tanggungan_keluarga = TanggunganKeluargaModel::where('personil_id', $personil->id)->get();
            
            return view('admin.personil.tanggungan-keluarga.index', compact('personil', 'tanggungan_keluarga'));
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
            'tempat_tanggal_lahir' => 'required|string|max:50',
            'status_hubungan' => 'required',
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
            'tempat_tanggal_lahir' => $validatedData['tempat_tanggal_lahir'],
            'status_hubungan' => $validatedData['status_hubungan'],
            'keterangan' => $validatedData['keterangan'],
            'personil_id' => $validatedData['personil_id'],
        ]);

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

        $tanggungan_keluarga = TanggunganKeluargaModel::where('personil_id', $personil->id)
            ->find($tanggunganKeluaragaId);

        if ($tanggungan_keluarga == null) {
            return abort(404);
        }

        return view('admin.personil.tanggungan-keluarga.edit', compact('personil', 'tanggungan_keluarga'));
    }

    public function update(Request $request, $nrp, $tanggunganKeluaragaId)
    {
        // Validasi data yang masuk
        $validatedData = $request->validate([
            'nama_lengkap' => 'required|string|max:25',
            'tempat_tanggal_lahir' => 'required|string|max:50',
            'status_hubungan' => 'required',
            'keterangan' => 'nullable|string',
            'personil_id' => 'required',
        ],);

        $nrpGanti = str_replace('-', '/', $nrp);
        $personil = PersonilModel::where('nrp', $nrpGanti)->first();

        if ($personil == null) {
            return abort(404);
        }

        $tanggungan_keluarga = TanggunganKeluargaModel::where('personil_id', $personil->id)
            ->find($tanggunganKeluaragaId);

        if ($tanggungan_keluarga == null) {
            return abort(404);
        }

        // Update data tanggungan_keluarga
        $tanggungan_keluarga->update([
            'nama_lengkap' => $validatedData['nama_lengkap'],
            'tempat_tanggal_lahir' => $validatedData['tempat_tanggal_lahir'],
            'status_hubungan' => $validatedData['status_hubungan'],
            'keterangan' => $validatedData['keterangan'],
        ]);

        return redirect()->route('admin.personil.tanggungan-keluarga.index', ['nrp' => $nrp])->with('success', 'Data tanggungan keluarga personil berhasil diperbarui.');
    }

            return abort(404);
        }

        // Hapus data TanggunganKeluarga
        $tanggungan_keluarga->delete();

        return redirect()->route('admin.personil.tanggungan-keluarga.index', ['nrp' => $nrp])
            ->with('success', 'Data tanggungan keluarga berhasil dihapus.');
    }
}
