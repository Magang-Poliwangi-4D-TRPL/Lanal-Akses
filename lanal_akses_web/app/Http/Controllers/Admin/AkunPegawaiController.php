<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PegawaiModel;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class AkunPegawaiController extends Controller
{
    public function index($nip){
        $pegawai = PegawaiModel::where('nip', str_replace('-', ' ', $nip))->first();
        
        if ($pegawai == null) {
            return abort(404);
        } else {
            $user = User::where('pegawai_id', $pegawai->id)->get()->first();
            // dd($user);
            return view('admin.pegawai.akun.index', compact('pegawai', 'user'));
        }
    }
    
    public function create($nip){
        $pegawai = PegawaiModel::where('nip', str_replace('-', ' ', $nip))->first();
        if (auth()->user()->hasRole('admin')) {
            # code...
            $roles = Role::all();
        } else {
            $roles = Role::where('name', '!=', 'admin')->get();
        }
        if ($pegawai == null) {
            return abort(404);
        } else {
            
            return view('admin.pegawai.akun.create', compact('pegawai', 'roles'));
        }
    }

    public function store(Request $request, $nip){

        // Validasi data yang masuk
        $validatedData = $request->validate([
            'nama_lengkap' => 'required|string|max:50',
            'username' => 'required|unique:users',
            'password' => 'required',
            'role' => 'required',
            'pegawai_id' => 'required',
        ],);

        $pegawai = pegawaiModel::where('nip', str_replace('-', ' ', $nip))->first();
        
        if ($pegawai == null) {
            return abort(404);
        }

        $user = new User([
            'nama_lengkap' => $validatedData['nama_lengkap'],
            'username' => $validatedData['username'],
            'password' => Hash::make($validatedData['password']),
            'pegawai_id' => $validatedData['pegawai_id'],
        ]);

        $user->assignRole($validatedData['role']);

        // Hubungkan dengan pegawai
        $user->save();

        return redirect()->route('admin.pegawai.akun.index', ['nip' => $nip])
            ->with('success', 'Data akun pegawai berhasil ditambahkan.');
    }
    
    
    public function edit($nip, $akunId){
        $pegawai = PegawaiModel::where('nip', str_replace('-', ' ', $nip))->first();
        if (auth()->user()->hasRole('admin')) {
            # code...
            $roles = Role::all();
        } else {
            $roles = Role::where('name', '!=', 'admin')->get();
        }
        if ($pegawai == null) {
            return abort(404);
        } else {
            $user = User::where('pegawai_id', $pegawai->id)->get()->first();
            // dd($user);
            return view('admin.pegawai.akun.edit', compact('pegawai', 'user', 'roles'));
        }
    }

    public function update(Request $request, $nip)
    {
        $request->validate([
            'nama_lengkap' => 'required',
            'password' => 'required',
            'role' => 'required',
        ]);

        $pegawai = pegawaiModel::where('nip', str_replace('-', ' ', $nip))->first();
        if ($pegawai == null) {
            return abort(404, 'pegawai Tidak Ditemukan');
        } else {
            $user = User::where('pegawai_id', $pegawai->id)->get()->first();
            $user->update([
                'nama_lengkap' => $request->nama_lengkap,
                'password' => Hash::make($request->password),
            ]);
            $user->assignRole($request->role);

    
            return redirect()->route('admin.pegawai.akun.index' ,['nip'=>$nip])->with('success', 'User pegawai berhasil diperbarui.');
        }
        
    }
    
}
