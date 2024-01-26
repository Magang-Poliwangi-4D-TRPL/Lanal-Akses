@extends('layout.admin.app')

@section('title-page', 'Admin | Data Role dan Permission')

@section('content')
<div class="container">
<div class="bg-white mb-5 overflow-hidden shadow-sm sm:rounded-lg">
    <div class="container py-4">

        <form method="POST" action="{{ route('admin.permission.store') }}">
            @csrf
            <div class="form-group">
              <label for="name">Massukkan permission role baru</label>
              <input type="text" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" id="name" name="name" required placeholder="Nama name">
              <small class="form-text mt-2 text-muted">Keterangan: gunakan huruf kecil dan gunakan spasi contoh: can access dashboard</small>
            </div>
            @error('name')
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
</div>
@endsection