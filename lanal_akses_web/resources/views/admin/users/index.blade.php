@extends('layout.admin.app')

@section('title-page', 'Admin | Data Akun Admin')

@section('content')
    <style>
        .active{
            text-decoration: underline;
            color: #0D21A1!important;
        }
        .pagination a{
            color: gray;
        }
    </style>
    <div class="container">
        <h1 class="text-black my-4">Data Akun Admin</h1>
        <div class="container bg-white border rounded p-5 mt-4">
            
                <a class="text-decoration-none" href="{{  route('users.create') }}">
                    <button class="btn btn-blue btn-md text-white bg-blueaccent">Tambah Akun Admin<span><iconify-icon class="ml-2" icon="ic:baseline-person-add-alt" width="16"></iconify-icon></span></button>
                </a>
            <table class="table thead-light">
                <thead>
                    <tr class="bg-bluedark text-white text-bold">
                      <th scope="col" width="10%">no</th>
                      <th scope="col" width="15%">Nama Lengkap</th>
                      <th scope="col" width="10%">Username</th>
                      <th scope="col" width="20%">Role</th>
                      <th scope="col" width="15%">Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                    @if ($users->count() > 0)
                    @foreach ($users as $user)
                        <tr>
                            <td>{{ $user->nama_lengkap }}</td>
                            <td>{{ $user->username }}</td>
                            <td>{{ $user->role }}</td>
                            <td>
                                <a href="{{ route('users.edit', $user->id) }}" class="btn btn-primary">Edit</a>
                                <form action="{{ route('users.destroy', $user->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus user ini?')">Hapus</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    @else
                    <tr>
                        <td colspan="5">Tidak ada data.</td>
                    </tr>
                    @endif
                    
                  </tbody>
                  
            </table>
            <div class="pagination">
                @if ($page > 1)
                    <a href="{{ route('admin.users.index', ['page' => $page - 1]) }}" class="text-decoration-none mx-2 previous">&laquo; Sebelumnya</a>
                @endif
            
                @for ($i = $firstNav; $i <= $lastNav; $i++)
                    <a href="{{ route('admin.users.index', ['page' => $i]) }}" class="text-decoration-none mx-2 {{ $page == $i ? 'active' : '' }}">{{ $i }}</a>
                @endfor
            
                @if ($page < $totalPages)
                    <a href="{{ route('admin.users.index', ['page' => $page + 1]) }}" class="text-decoration-none mx-2 next">Selanjutnya &raquo;</a>
                @endif
            </div>
        </div>
    </div>
@endsection