<?php

namespace App\Http\Controllers\Personil;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class PersonilController extends Controller
{
    public function personilDashboard(){
        return view('personil.dashboard');
    }

    public function edit(){
        return view('personil.editprofile');
    }

    public function absensi(){
        return view('personil.absensi');
    }

    public function perizinan(){
        return view('personil.perizinan');
    }

    public function login(){
        return view('personil.login');
    }
    
    public function loginPost(Request $request){
        $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);
        
        $user = User::all();
        if ($user->count() <= 0) {
            return abort('404', 'Belum ada akun yang dibuat');
        }
        
        dd($request);
    }
}
