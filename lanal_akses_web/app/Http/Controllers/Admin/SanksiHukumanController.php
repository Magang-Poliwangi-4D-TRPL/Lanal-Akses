<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PersonilModel;
use App\Models\SanksiHukumanModel;
use Illuminate\Http\Request;

class SanksiHukumanController extends Controller
{
    public function index($nrp) {
        $nrpGanti = str_replace('-', '/', $nrp);
        $personil = PersonilModel::where('nrp', $nrpGanti)->first();
        
        if($personil == null){
            return abort(404);
        } else {
            // Mengambil semua data SanksiHukumanModel yang memiliki personil_id yang sama dengan id PersonilModel yang dicari
            $sanksiHukuman = SanksiHukumanModel::where('personil_id', $personil->id)->get();
            
            return view('admin.personil.sanksi-hukuman.index', compact('personil', 'sanksiHukuman'));
        }

    }

    public function create($nrp)
    {
        $nrpGanti = str_replace('-', '/', $nrp);
        $personil = PersonilModel::where('nrp', $nrpGanti)->first();
        return view('admin.personil.sanksi-hukuman.create', compact('personil'));
    }

    public function edit($nrp, $sanksiHukumanId)
    {
        $nrpGanti = str_replace('-', '/', $nrp);
        $personil = PersonilModel::where('nrp', $nrpGanti)->first();

        if ($personil == null) {
            return abort(404);
        }

        $sanksiHukuman = SanksiHukumanModel::where('personil_id', $personil->id)
            ->find($sanksiHukumanId);

        if ($sanksiHukuman == null) {
            return abort(404);
        }

        return view('admin.personil.sanksi-hukuman.edit', compact('personil', 'sanksiHukuman'));
    }
}
