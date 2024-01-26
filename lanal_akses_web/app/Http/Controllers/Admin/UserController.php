<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

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
            $title = 'All User';
            return view('admin.users.index', compact('users', 'page', 'totalPages', 'firstNav', 'lastNav', 'title'));
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

        $title = 'All User';
        return view('admin.users.index', compact('users', 'page', 'totalPages', 'firstNav', 'lastNav', 'title'));

    }
    public function indexPersonil ($page)
    {
        $perPage = 10; // Jumlah data per halaman
        $totalUser = User::count();
        if ($totalUser == 0){
            $users = User::all();
            $totalPages = 0;
            $firstNav = 1;
            $lastNav = 1;
            $title = 'Personel';
            return view('admin.users.index', compact('users', 'page', 'totalPages', 'firstNav', 'lastNav', 'title'));
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
        $users = User::role('personel')->skip($offset)->take($perPage)->get();

        $title = 'Personel';
        return view('admin.users.index', compact('users', 'page', 'totalPages', 'firstNav', 'lastNav', 'title'));

    }

    public function indexPegawai($page)
    {
        $perPage = 10; // Jumlah data per halaman
        $totalUser = User::count();
        if ($totalUser == 0){
            $users = User::all();
            $totalPages = 0;
            $firstNav = 1;
            $lastNav = 1;
            $title = 'Pegawai';
            return view('admin.users.index', compact('users', 'page', 'totalPages', 'firstNav', 'lastNav', 'title'));
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
        $users = User::role('pegawai')->skip($offset)->take($perPage)->get();

        $title = 'Pegawai';
        return view('admin.users.index', compact('users', 'page', 'totalPages', 'firstNav', 'lastNav', 'title'));

    }

    public function indexAdmin($page)
    {
        $perPage = 10; // Jumlah data per halaman
        $totalUser = User::count();
        if ($totalUser == 0){
            $users = User::all();
            $totalPages = 0;
            $firstNav = 1;
            $lastNav = 1;
            $title = 'Admin';
            return view('admin.users.index', compact('users', 'page', 'totalPages', 'firstNav', 'lastNav', 'title'));
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

        $title = 'Admin';

        // Mengambil data dengan offset berdasarkan halaman
        if (auth()->user()->hasRole('admin')) {
            # code...
            $users = User::whereDoesntHave('roles', function ($query) {
                $query->whereIn('name', ['personel', 'pegawai']);
            })->skip($offset)->take($perPage)->get();
        } else {
            $users = User::whereDoesntHave('roles', function ($query) {
                $query->whereIn('name', ['admin', 'personel', 'pegawai']);
            })->skip($offset)->take($perPage)->get();

        }
        return view('admin.users.index', compact('users', 'page', 'totalPages', 'firstNav', 'lastNav', 'title'));

    }

    public function search(Request $request) {
        $perPage = 100; // Jumlah data per halaman
        $query = $request->input('q');

        // Query pencarian berdasarkan nama atau NRP
        $users = User::where('nama_lengkap', 'like', '%' . $query . '%')
            ->orWhere('username', 'like', '%' . $query . '%')
            ->paginate($perPage);

        return view('admin.users.search', compact('users', 'query'));
    }

    public function create()
    {
        if (auth()->user()->hasRole('admin')) {
            # code...
            $roles = Role::all();
        } else {
            $roles = Role::where('name', '!=', 'admin')->get();
        }
        return view('admin.users.create', compact('roles'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_lengkap' => 'required',
            'username' => 'required|unique:users',
            'password' => 'required',
            'role' => 'required',
        ]);

        $user = User ::create([
            'nama_lengkap' => $request->nama_lengkap,
            'username' => $request->username,
            'password' => Hash::make($request->password),
        ]);

        $user->assignRole($request->role);

        return redirect()->route('admin.users.index',['page' => 1])->with('success', 'Admin telah berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $user = User::find($id);
        if (auth()->user()->hasRole('admin')) {
            # code...
            $roles = Role::all();
        } else {
            $roles = Role::where('name', '!=', 'admin')->get();
        }
        if($user==null){
            return abort(404);
        } else {
            // dd($user);
            return view('admin.users.edit', compact('user', 'roles'));

        }
        
    }

    public function update(Request $request, $id)
    {
        $user = User::find($id);
        if (!$user) {
            return redirect()->back()->with('error', 'User tidak ditemukan.');
        }

        $validateData = $request->validate([
            'nama_lengkap' => 'required|string',
            'username' => 'required|unique:users,username,' . $user->id,
            'email' => 'nullable|email|unique:users,email,' . $user->id,
            'password' => 'nullable|min:6|confirmed',
            'role' => 'required',
        ], [
            'nama_lengkap.required' => 'Nama Lengkap harus diisi.',
            'username.required' => 'Username harus diisi.',
            'username.unique' => 'Username tidak dapat dipakai karena sudah digunakan.',
            'email.email' => 'Email harus diisi dengan format yang benar.',
            'email.unique' => 'Email tidak dapat dipakai karena sudah digunakan.',
            'password.min' => 'Password minimal 6 karakter.',
            'password.confirmed' => 'Password tidak sama, coba lagi!',
            'role.required' => 'Username harus diisi.',
        ]);

        if ($validateData['password'] == null) {
            $user->update([
                'nama_lengkap' => $validateData['nama_lengkap'],
                'username' => $validateData['username'],
                'email' => $validateData['email'],
            ]);
        } else {
            $user->update([
                'nama_lengkap' => $validateData['nama_lengkap'],
                'username' => $validateData['username'],
                'email' => $validateData['email'],
                'password' => Hash::make($validateData['password']),
            ]);
        }

        $requestedRole = $request->role;
        
        if ($user->getRoleNames()->first() == null) {
            $role = Role::where('name', $requestedRole)->first();
            $user->assignRole($role);
        } else {
            
            if ($requestedRole !== $user->getRoleNames()->first()) {
                // Hapus role lama dari user
                $user->removeRole($user->getRoleNames()->first());
        
                // Tambahkan role baru ke user
                $role = Role::where('name', $requestedRole)->first();
        
                if ($role) {
                    $user->assignRole($role);
                } else {
                    return redirect()->back()->with('error', 'Role baru tidak valid.');
                }
            }
        }
        return redirect()->route('admin.users.index', ['page' => 1])->with('success', 'Admin telah berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();
        return redirect()->route('admin.users.index', ['page' => 1])->with('error', 'Admin telah berhasil dihapus.');
    }
}
