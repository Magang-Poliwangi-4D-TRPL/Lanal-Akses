<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PegawaiModel;
use App\Models\PersonilModel;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(){
        $personil = PersonilModel::all();
        $pns = PegawaiModel::all();

        return view('admin.dashboard', compact('personil', 'pns'));

    }
}
