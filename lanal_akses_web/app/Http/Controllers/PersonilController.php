<?php

namespace App\Http\Controllers;

use App\Models\PersonilModel;

class PersonilController extends Controller
{
    public function index($page) {
        $perPage = 10; // Jumlah data per halaman

        // Menghitung offset berdasarkan halaman yang diminta
        $offset = ($page - 1) * $perPage;

        // Mengambil data dengan offset berdasarkan halaman
        $personil = PersonilModel::skip($offset)->take($perPage)->get();
        return view('admin.personil.index', compact('personil', 'page'));
    }

    public function show($nrp) {
        $nrpGanti = str_replace('-', '/', $nrp);
        $personil = PersonilModel::where('nrp', $nrpGanti)->first();
        // dd($personil);
        return view('admin.personil.show', compact('personil'));
    }
}
