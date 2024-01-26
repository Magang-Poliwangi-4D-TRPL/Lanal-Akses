<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    public function index()
    {
        if (auth()->user()->hasRole('admin')) {
            $permissions = Permission::all();
        } else {
            $permissions = Permission::where('name', '!=', 'can access all')->get();
        }
        

        return view('admin.permission.index', compact('permissions'));
    }

    public function create()
    {
        return view('admin.permission.create');
    }

    public function store(Request $request)
    {
        
        $request->validate([
            'name' => [
                'required',
                'unique:permissions',
                'max:50',
                'regex:/^[a-z\s]+$/',
            ],
        ], [
            'name.reuired' => 'Name permission harus diisi!',
            'name.unique' => 'Name permission tidak bisa dipakai karena sudah digunakan!',
            'name.max' => 'Name permission terlalu panjang! tidak boleh melebihi 50 karakter',
            'name.regex' => 'Format penulisan name permission tidak sesuai!',
        ]);
        $permission = Permission::create([
            'name' => $request->name,
        ]);

        return redirect()->route('admin.permission.index')->with('success', 'Permission berhasil diperbarui.');
    }

    public function edit($idPermission)
    {
        $permission = Permission::find($idPermission);
        if (!$permission) {
            return redirect()->back()->with('error', 'Permission tidak ditemukan.');
        } else {
            return view('admin.permission.edit', compact('permission'));
        }
    }

    public function update(Request $request, $idPermission)
    {
        $permission = Permission::find($idPermission);

        $request->validate([
            'name' => [
                'required',
                'max:50',
                'regex:/^[a-z\s]+$/',
                Rule::unique('permissions', 'name')->ignore($permission->id),
            ],
        ], [
            'name.required' => 'Name permission harus diisi!',
            'name.unique' => 'Name permission tidak bisa dipakai karena sudah digunakan!',
            'name.max' => 'Name permission terlalu panjang! tidak boleh melebihi 50 karakter',
            'name.regex' => 'Format penulisan name permission tidak sesuai!',
        ]);

        if (!$permission) {
            return redirect()->back()->with('error', 'Permission tidak ditemukan.');
        } else {
            $permission->update([
                'name' => $request->name,
            ]);
        }

        return redirect()->route('admin.permission.index')->with('success', 'Permission dihapus.');
    }


    public function destroy($idPermission)
    {
        $permission = Permission::find($idPermission);

        if (!$permission) {
            return redirect()->route('admin.permission.index')->with('error', 'Permission tidak ditemukan.');
        }

        $permission->delete();

        return redirect()->route('admin.permission.index')->with('success', 'Permission berhasil dihapus.');
    }
}
