<?php

namespace App\Http\Controllers\Admin;

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
            return abort(404);
        } else {
            // Mengambil semua data DataKepangkatanModel yang memiliki personil_id yang sama dengan id PersonilModel yang dicari
            $dataKepangkatan = DataKepangkatanModel::where('personil_id', $personil->id)->get();
            
            return view('admin.personil.data-kepangkatan.index', compact('personil', 'dataKepangkatan'));
        }

    }

    public function create($nrp)
    {
        $nrpGanti = str_replace('-', '/', $nrp);
        $personil = PersonilModel::where('nrp', $nrpGanti)->first();
        return view('admin.personil.data-kepangkatan.create', compact('personil'));
    }

    public function edit($nrp, $dataKepangkatanId)
    {
        $nrpGanti = str_replace('-', '/', $nrp);
        $personil = PersonilModel::where('nrp', $nrpGanti)->first();

        if ($personil == null) {
            return abort(404);
        }

        $dataKepangkatan = DataKepangkatanModel::where('personil_id', $personil->id)
            ->find($dataKepangkatanId);

        if ($dataKepangkatan == null) {
            return abort(404);
        }

        return view('admin.personil.data-kepangkatan.edit', compact('personil', 'dataKepangkatan'));
    }
}
