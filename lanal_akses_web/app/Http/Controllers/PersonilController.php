<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PersonilController extends Controller
{
    public function index() {
        return view('admin.personil.index');
    }
}
