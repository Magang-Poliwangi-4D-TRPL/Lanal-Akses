@extends('layout.admin.app')

@section('title-page', 'Admin | Data Role dan Permission')

@section('content')
<div class="container">

    @if(auth()->user()->canany(['can access all', 'manage role']) )
    <div class="bg-white my-3 overflow-hidden shadow-sm sm:rounded-lg">
        <div class="row p-4 justify-content-between align-item-center">
            <div class="col-md-6 py-auto">
                <h4 class="h4 text-capitalize">Tabel Permission</h4>
            </div>
            <div class="col-md-6 py-auto text-right">
                @if(auth()->user()->canany(['can access all', 'manage permission']))
                {{-- {{ route('admin.pegawai.create') }} --}}
                <a href="{{ route('admin.permission.create') }}" class="btn btn-primary text-capitalize">Tambah Permission <i class="bi bi-plus"></i></a>
                @endif
            </div>
        </div>
        <table class="table">
            <tr class="bg-info text-white">
                <th width="5%">NO</th>
                <th width="40%">Nama Permission</th>
                <th width="25%">Guard Name</th>
                <th width="30%">Aksi</th>
            </tr>
            @if ($permissions->count()!=0)
            @foreach($permissions as $data_permission)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $data_permission->name }}</td>
                <td>{{ $data_permission->guard_name }}</td>
                <td>
                    <div class="row justify-content-beetween">
                        <div class="col-md-4">
                            @if(auth()->user()->canany(['can access all', 'manage permission']))
                            {{-- {{ route('admin.permission.edit', ['idUser' => $data_permission->id]) }} --}}
                            <a href="{{ route('admin.permission.edit', ['idPermission' => $data_permission->id]) }}" class="btn btn-primary">Edit</a>
                            @endif
                            </div>
                            <div class="col-md-4">
                                @if(auth()->user()->canany(['can access all', 'manage permission']))
                                <form method="POST" action="{{ route('admin.permission.delete', ['idPermission' => $data_permission->id]) }}" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus permission ini?')">Hapus</button>
                                </form>
                                @endif
                            </div>
                        </div>
                    </td>
                </tr>
                @endforeach
                @else
                <tr>
                    <td colspan="5">Tidak ada data permission</td>
                </tr>
            @endif
        </table>
    </div>
    
</div>
@endif
</div>
@endsection