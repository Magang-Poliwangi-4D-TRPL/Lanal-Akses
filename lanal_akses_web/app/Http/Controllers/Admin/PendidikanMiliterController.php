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
}
