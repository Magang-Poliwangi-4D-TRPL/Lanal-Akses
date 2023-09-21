<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index($page)
    {
        $perPage = 10; // Jumlah data per halaman
        $totalUser = User::count();
        if ($totalUser == 0){
            $users = User::all();
            $totalPages = 0;
            $firstNav = 1;
            $lastNav = 1;
            return view('admin.users.index', compact('users', 'page', 'totalPages', 'firstNav', 'lastNav'));
        }
        $totalPages = ceil($totalUser / $perPage);

        // Pastikan $page berada dalam rentang halaman yang valid
        if ($page <= 0 || $page > $totalPages) {
            return abort(404);
        }

        // Hitung batasan angka navigasi
        $maxNavLinks = 5;
        $halfMaxLinks = floor($maxNavLinks / 2);
        $firstNav = max(1, $page - $halfMaxLinks);
        $lastNav = min($totalPages, $firstNav + $maxNavLinks - 1);

        // Menghitung offset berdasarkan halaman yang diminta
        $offset = ($page - 1) * $perPage;

        // Mengambil data dengan offset berdasarkan halaman
        $users = User::skip($offset)->take($perPage)->get();
        return view('admin.users.index', compact('users', 'page', 'totalPages', 'firstNav', 'lastNav'));

    }

    public function create()
    {
        return view('admin.users.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_lengkap' => 'required',
            'username' => 'required|unique:users',
            'password' => 'required',
            'role' => 'required',
        ]);

        User ::create([
            'nama_lengkap' => $request->nama_lengkap,
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'role' => $request->role,
        ]);

        return redirect()->route('users.index')->with('success', 'Admin telah berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $user = User::find($id);
        return view('admin.users.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_lengkap' => 'required',
            'username' => 'required|unique:users,username,' . $id,
            'password' => 'required',
            'role' => 'required',
        ]);

        $user = User ::find($id);
        $user->update([
            'nama_lengkap' => $request->nama_lengkap,
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'role' => $request->role,
        ]);

        return redirect()->route('users.index')->with('success', 'Admin telah berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();
        return redirect()->route('users.index')->with('error', 'Admin telah berhasil dihapus.');
    }
}
