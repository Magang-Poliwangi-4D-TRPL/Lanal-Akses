@extends('layout.admin.app')

@section('title-page', 'Admin | Data Role dan Permission')

@section('content')
<div class="container">

    @if(auth()->user()->canany(['can access all', 'manage role']) )
    <div class="bg-white my-3 overflow-hidden shadow-sm sm:rounded-lg">
        {{-- Role --}}
        <div class="row p-4 justify-content-between align-item-center">
            <div class="col-md-6 py-auto">
                <h4 class="h4 text-capitalize">Tabel Role</h4>
            </div>
            <div class="col-md-6 py-auto text-right">
                @if(auth()->user()->canany(['can access all', 'manage role']))
                {{-- {{ route('admin.pegawai.create') }} --}}
                <a href="{{ route('admin.role.create') }}" class="btn btn-primary text-capitalize">Tambah Role <i class="bi bi-plus"></i></a>
                @endif
            </div>
        </div>
        <table class="table">
            <tr class="bg-info text-white">
                <th width="5%">NO</th>
                <th width="40%">Nama Role</th>
                <th width="25%">Guard Name</th>
                <th width="30%">Aksi</th>
            </tr>
            @if ($roles->count()!=0)
                @foreach($roles as $data_role)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $data_role->name }}</td>
                    <td>{{ $data_role->guard_name }}</td>
                    <td>
                        <div class="row justify-content-beetween">
                            <div class="col-md-4">
                                @if(auth()->user()->canany(['can access all', 'manage role']))
                                {{-- {{ route('admin.role.edit', ['idUser' => $data_role->id]) }} --}}
                                <a href="{{ route('admin.role.edit', ['idRole' => $data_role->id]) }}" class="btn btn-primary">Edit</a>
                                @endif
                            </div>
                            <div class="col-md-4">
                                @if(auth()->user()->canany(['can access all', 'manage role']))
                                <form method="POST" action="{{ route('admin.role.delete', ['idRole' => $data_role->id]) }}" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus role ini?')">Hapus</button>
                                </form>
                                @endif
                            </div>
                        </div>
                    </td>
                </tr>
                @endforeach
                @else
                <tr>
                    <td colspan="5">Tidak ada data role</td>
                </tr>
            @endif
            
        </table>
    </div>
    
</div>
@endif
</div>
@endsection