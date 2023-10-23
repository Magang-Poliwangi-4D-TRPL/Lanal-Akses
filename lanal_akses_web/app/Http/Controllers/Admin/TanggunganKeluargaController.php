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
}
