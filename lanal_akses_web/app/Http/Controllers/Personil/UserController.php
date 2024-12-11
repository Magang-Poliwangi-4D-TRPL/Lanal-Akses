<?php

namespace App\Http\Controllers\Personil;

use App\Http\Controllers\Controller;
use App\Models\PersonilModel;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function index($nrp){
        $personil = PersonilModel::where('nrp', str_replace('-', '/', $nrp))->first();
        
        if ($personil == null) {
            return redirect()->back()->withErrors(['message' => 'Data personel tidak ditemukan.']);
        } else {
            $user = User::where('personil_id', $personil->id)->get();
            // dd($user);
            return view('personil.akun.index', compact('personil', 'user'));
        }
    }
public function edit($nrp){
        $personil = PersonilModel::where('nrp', str_replace('-', '/', $nrp))->first();
        if (auth()->user()->hasRole('admin')) {
            # code...
            $roles = Role::all();
        } else {
            $roles = Role::where('name', '!=', 'admin')->get();
        }
        if ($personil == null) {
            return redirect()->back()->withErrors(['message' => 'Data personel tidak ditemukan.']);
        } else {
            $user = User::where('personil_id', $personil->id)->get();
            
            return view('personil.akun.edit', compact('personil', 'user', 'roles'));
        }
    }

    public function update(Request $request, $nrp)
    {
        $request->validate([
            'nama_lengkap' => 'required',
            'password' => 'required',
        ]);


        $personil = PersonilModel::where('nrp', str_replace('-', '/', $nrp))->first();
        if ($personil == null) {
            return redirect()->back()->withErrors(['message' => 'Data personel tidak ditemukan.']);
        } else {
            $user = User::where('personil_id', $personil->id)->get()->first();
            $user->update([
                'nama_lengkap' => $request->nama_lengkap,
                'password' => Hash::make($request->password),
            ]);
            return redirect()->route('personil.dashboard')->with('success', 'User personel berhasil diperbarui.');
        }
        
    }
}
