<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PersonilModel;
use App\Models\TandaJasaModel;
use Illuminate\Http\Request;

class TandaJasaController extends Controller
{
    public function index($nrp) {
        $nrpGanti = str_replace('-', '/', $nrp);
        $personil = PersonilModel::where('nrp', $nrpGanti)->first();
        
        if($personil == null){
            return abort(404);
        } else {
            // Mengambil semua TandaJasaModel yang memiliki personil_id yang sama dengan id PersonilModel yang dicari
            $tandaJasa = TandaJasaModel::where('personil_id', $personil->id)->get();
            
            return view('admin.personil.tanda-jasa.index', compact('personil', 'tandaJasa'));
        }

    }

    public function create($nrp)
    {
        $nrpGanti = str_replace('-', '/', $nrp);
        $personil = PersonilModel::where('nrp', $nrpGanti)->first();
        return view('admin.personil.tanda-jasa.create', compact('personil'));
    }

    public function edit($nrp, $tandaJasaId)
    {
        $nrpGanti = str_replace('-', '/', $nrp);
        $personil = PersonilModel::where('nrp', $nrpGanti)->first();

        if ($personil == null) {
            return abort(404);
        }

        $tandaJasa = TandaJasaModel::where('personil_id', $personil->id)
            ->find($tandaJasaId);

        if ($tandaJasa == null) {
            return abort(404);
        }

        return view('admin.personil.tanda-jasa.edit', compact('personil', 'tandaJasa'));
    }
}
