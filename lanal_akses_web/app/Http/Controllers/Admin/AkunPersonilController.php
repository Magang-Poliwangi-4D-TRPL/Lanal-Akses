<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PersonilModel;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class AkunPersonilController extends Controller
{
    public function index($nrp){
        $personil = PersonilModel::where('nrp', str_replace('-', '/', $nrp))->first();
        
        if ($personil == null) {
            return abort(404);
        } else {
            $user = User::where('personil_id', $personil->id)->get();
            // dd($user);
            return view('admin.personil.akun.index', compact('personil', 'user'));
        }
    }
    
    public function create($nrp){
        $personil = PersonilModel::where('nrp', str_replace('-', '/', $nrp))->first();
        if (auth()->user()->hasRole('admin')) {
            # code...
            $roles = Role::all();
        } else {
            $roles = Role::where('name', '!=', 'admin')->get();
        }
        if ($personil == null) {
            return abort(404);
        } else {            
            return view('admin.personil.akun.create', compact('personil', 'roles'));
        }
    }

    public function store(Request $request, $nrp){

        // Validasi data yang masuk
        $validatedData = $request->validate([
            'nama_lengkap' => 'required|string|max:50',
            'username' => 'required|unique:users',
            'password' => 'required',
            'role' => 'required',
            'personil_id' => 'required',
        ],);

        $personil = PersonilModel::where('nrp', str_replace('-', '/', $nrp))->first();
        
        if ($personil == null) {
            return abort(404);
        }

        $user = new User([
            'nama_lengkap' => $validatedData['nama_lengkap'],
            'username' => $validatedData['username'],
            'password' => Hash::make($validatedData['password']),
            'personil_id' => $validatedData['personil_id'],
        ]);

        $user->assignRole($validatedData['role']);
        // Hubungkan dengan personil
        $user->save();

        return redirect()->route('admin.personil.akun.index', ['nrp' => $nrp])
            ->with('success', 'Data akun personil berhasil ditambahkan.');
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
            return abort(404);
        } else {
            $user = User::where('personil_id', $personil->id)->get();
            
            return view('admin.personil.akun.edit', compact('personil', 'user', 'roles'));
        }
    }

    public function update(Request $request, $nrp)
    {
        $request->validate([
            'nama_lengkap' => 'required',
            'password' => 'required',
            'role' => 'required',
        ]);

        $personil = PersonilModel::where('nrp', str_replace('-', '/', $nrp))->first();
        if ($personil == null) {
            return abort(404, 'Personil Tidak Ditemukan');
        } else {
            $user = User::where('personil_id', $personil->id)->get();
            $user[0]->update([
                'nama_lengkap' => $request->nama_lengkap,
                'password' => Hash::make($request->password),
            ]);
            $user[0]->assignRole($request->role);
            return redirect()->route('admin.personil.akun.index' ,['nrp'=>$nrp])->with('success', 'User personel berhasil diperbarui.');
        }
        
    }
}
