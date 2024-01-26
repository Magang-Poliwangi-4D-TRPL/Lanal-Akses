@extends('layout.admin.app')

@section('title-page', 'Admin | Data Role dan Permission')

@section('content')
<div class="container">
<div class="container bg-white py-4">

    <form method="POST" action="{{ route('admin.role.store') }}">
        @csrf
        <div class="form-group">
          <label for="name">Massukkan nama role baru</label>
          <input type="text" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" id="name" name="name" required placeholder="Nama name">
          <small class="form-text mt-2 text-muted">Keterangan: gunakan huruf kecil dan jangan gunakan spasi, jika terdapat angka maka gabungkan dengan nama, contoh: staff1</small>
        </div>
        @error('name')
        <div class="alert alert-danger" role="alert">
            <p class="p-0 m-0">{{ $message }}</p>
        </div>
        @enderror
        <div class="form-group">
            <label for="permissions">Pilih Permissions untuk Role Baru</label>
            <div>
                @foreach($permissions as $permission)
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="{{ $permission->name }}" name="permissions[]" value="{{ $permission->name }}" {{ in_array($permission->name, old('permissions', [])) ? 'checked' : '' }}>
                        <label class="form-check-label" for="{{ $permission->name }}">
                            {{ $permission->name }}
                        </label>
                    </div>
                @endforeach
            </div>
        </div>
        @error('permissions')
            <div class="alert alert-danger" role="alert">
                <p class="p-0 m-0">{{ $message }}</p>
            </div>
        @enderror
        
        <div class="row jusitify-content-betwwen">
            <div class="col-md-6">
                <a href="{{ route('dashboard') }}" class="btn btn-light"><i class="bi bi-arrow-left"></i> Kembali</a>

            </div>
            <div class="col-md-6 text-right">
                <button type="submit" class="btn btn-primary">Submit <i class="bi bi-check-circle"></i></button>

            </div>
        </div>
    </form>    
</div>   
</div>
@endsection