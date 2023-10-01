<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PersonilModel;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(){
        $personil = PersonilModel::all();
        $pns = '20';

        return view('admin.dashboard', compact('personil', 'pns'));

    }
}