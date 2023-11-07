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

    public function edit($nrp, $riwayatPenugasan)
    {
        $nrpGanti = str_replace('-', '/', $nrp);
        $personil = PersonilModel::where('nrp', $nrpGanti)->first();

        if ($personil == null) {
            return abort(404);
        }

        $riwayatPenugasan = RiwayatPenugasanModel::where('personil_id', $personil->id)
            ->find($riwayatPenugasan);

        if ($riwayatPenugasan == null) {
            return abort(404);
        }

        return view('admin.personil.riwayat-penugasan.edit', compact('personil', 'riwayatPenugasan'));
    }
}