<?php

namespace App\Http\Controllers;

use App\Models\PerlengkapanModel;
use App\Models\PersonilModel;
use Illuminate\Http\Request;

class PerlengkapanController extends Controller
{
    public function index($nrp) {
        $nrpGanti = str_replace('-', '/', $nrp);
        $personil = PersonilModel::where('nrp', $nrpGanti)->first();
        
        if($personil == null){
            return abort(404);
        } else {
            // Mengambil semua data PerlengkapanModel yang memiliki personil_id yang sama dengan id PersonilModel yang dicari
            $perlengkapan = PerlengkapanModel::where('personil_id', $personil->id)->get();
            
            return view('admin.personil.perlengkapan.index', compact('personil', 'perlengkapan'));
        }

    }
}
