<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    public function index()
    {
        if (auth()->user()->hasRole('admin')) {
            $roles = Role::all();
        } else {
            $roles = Role::where('name', '!=', 'admin')->get();
        }
        

        return view('admin.role.index', compact('roles'));
    }

    public function create()
    {
        $permissions = new Permission();
        if (Auth::user()->hasRole('admin')) {
            $permissions = Permission::all();
        } else {
            $permissions = Permission::where('name', '!=', 'can access all')->get();
        }
        return view('admin.role.create', compact('permissions'));
    }

    public function store(Request $request)
    {
        $permissions = new Permission();
        if (Auth::user()->hasRole('admin')) {
            $permissions = Permission::all();
        } else {
            $permissions = Permission::where('name', '!=', 'can access all')->get();
        }
        $request->validate([
            'name' => [
                'required',
                'unique:roles',
                'max:50',
                'regex:/^[a-z0-9]+$/',
            ],
            'permissions' => 'nullable|array',
            'permissions.*' => Rule::in($permissions->pluck('name')->toArray()),
        ], [
            'name.reuired' => 'Name role harus diisi!',
            'name.unique' => 'Name role tidak bisa dipakai karena sudah digunakan!',
            'name.max' => 'Name role terlalu panjang! tidak boleh melebihi 50 karakter',
            'name.regex' => 'Format penulisan name role tidak sesuai!',
        ]);
        $role = Role::create([
            'name' => $request->name,
        ]);

        $role->syncPermissions($request->permissions);

        return redirect()->route('admin.role.permission.index')->with('success', 'Role berhasil dibuat.');
    }

    public function edit($idRole)
    {
        $role = Role::find($idRole);

        if (!$role) {
            return redirect()->route('admin.role.permission.index')->with('error', 'Role tidak ditemukan.');
        }
        $permissions = new Permission();
        if (Auth::user()->hasRole('admin')) {
            $permissions = Permission::all();
        } else {
            $permissions = Permission::where('name', '!=', 'can access all')->get();
        }

        return view('admin.role.edit', compact('role', 'permissions'));
    }

    public function update(Request $request, $idRole)
    {
        $role = Role::find($idRole);
        $permissions = new Permission();
        if (Auth::user()->hasRole('admin')) {
            $permissions = Permission::all();
        } else {
            $permissions = Permission::where('name', '!=', 'can access all')->get();
        }
        if (!$role) {
            return redirect()->route('admin.role.permission.index')->with('error', 'Role tidak ditemukan.');
        }

        $request->validate([
            'name' => [
                'required',
                'max:255',
                Rule::unique('roles')->ignore($role->id),
                'regex:/^[a-z0-9]+$/',
            ],
            'permissions' => 'nullable|array',
            'permissions.*' => Rule::in($permissions->pluck('name')->toArray()),
        ]);

        $role->update([
            'name' => $request->name,
        ]);

        $role->syncPermissions($request->permissions);

        return redirect()->route('admin.role.permission.index')->with('success', 'Role berhasil diupdate.');
    }

    public function destroy($idRole)
    {
        $role = Role::find($idRole);

        if (!$role) {
            return redirect()->route('admin.role.permission.index')->with('error', 'Role tidak ditemukan.');
        }

        $role->delete();

        return redirect()->route('admin.role.permission.index')->with('success', 'Role berhasil dihapus.');
    }
}
