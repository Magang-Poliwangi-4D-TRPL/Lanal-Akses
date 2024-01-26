@extends('layout.admin.app')

@section('title-page', 'Admin | Data Akun Personel')

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
        <h1 class="text-black my-4">Data Akun {{ $title }}</h1>
        <div class="container bg-white border rounded p-5 mt-4">
            @if(request()->is('admin/users/akun-admin/*'))
                <div class="d-flex justify-content-between  my-3">
                    <a class="text-decoration-none" href="{{  route('users.create') }}">
                        <button class="btn btn-blue btn-md text-white bg-blueaccent">Tambah Akun Admin<span><iconify-icon class="ml-2" icon="ic:baseline-person-add-alt" width="16"></iconify-icon></span></button>
                    </a>
                </div>
            @endif
            <p>Jumlah total data: {{ $users->count() }}</p>
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
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $user->nama_lengkap }}</td>
                            <td>{{ $user->username }}</td>
                            <td>{{ $user->getRoleNames()->first() }}</td>
                            <td>
                                <a href="{{ route('users.edit', $user->id) }}" class="btn btn-primary">Edit</a>
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
                    @if (request()->is('admin/users/personil/*'))
                        <a href="{{ route('admin.akun-personil.index', ['page' => $page - 1]) }}" class="text-decoration-none mx-2 previous">&laquo; Sebelumnya</a>
                    @elseif(request()->is('admin/users/pegawai/*'))
                        <a href="{{ route('admin.akun-pegawai.index', ['page' => $page - 1]) }}" class="text-decoration-none mx-2 previous">&laquo; Sebelumnya</a>
                    @else
                        <a href="{{ route('admin.akun-admin.index', ['page' => $page - 1]) }}" class="text-decoration-none mx-2 previous">&laquo; Sebelumnya</a>
                    @endif
                @endif
            
                @for ($i = $firstNav; $i <= $lastNav; $i++)
                    @if (request()->is('admin/users/personil/*'))
                        <a href="{{ route('admin.akun-personil.index', ['page' => $i]) }}" class="text-decoration-none mx-2 {{ $page == $i ? 'active' : '' }}">{{ $i }}</a>
                    @elseif(request()->is('admin/users/pegawai/*'))
                        <a href="{{ route('admin.akun-pegawai.index', ['page' => $i]) }}" class="text-decoration-none mx-2 {{ $page == $i ? 'active' : '' }}">{{ $i }}</a>
                    @else
                        <a href="{{ route('admin.akun-admin.index', ['page' => $i]) }}" class="text-decoration-none mx-2 {{ $page == $i ? 'active' : '' }}">{{ $i }}</a>
                    @endif
                @endfor
            
                @if ($page < $totalPages)
                    @if (request()->is('admin/users/personil/*'))
                        <a href="{{ route('admin.akun-personil.index', ['page' => $page + 1]) }}" class="text-decoration-none mx-2 next">Selanjutnya &raquo;</a>
                    @elseif(request()->is('admin/users/pegawai/*'))
                        <a href="{{ route('admin.akun-pegawai.index', ['page' => $page + 1]) }}" class="text-decoration-none mx-2 next">Selanjutnya &raquo;</a>
                    @else
                        <a href="{{ route('admin.akun-admin.index', ['page' => $page + 1]) }}" class="text-decoration-none mx-2 next">Selanjutnya &raquo;</a>
                    @endif
                @endif
            </div>
        </div>
    </div>
@endsection