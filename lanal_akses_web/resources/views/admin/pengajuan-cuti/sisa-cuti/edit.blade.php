@extends('layout.admin.app')

@section('title-page', 'Admin | Batas Hari Cuti')

@section('content')
<div class="container">
<div class="container bg-white py-4">
    @if (session('alert'))
        <div class="alert alert-danger">
            {{ session('alert') }}
        </div>
    @endif

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if (session('warning'))
        <div class="alert alert-warning">
            {{ session('warning') }}
        </div>
    @endif
    <h4 class="mt-3">Ubah Sisa Cuti Personel</h4>
    <form method="POST" action="{{ route('admin.sisa-cuti.update',  $sisaCuti->id) }}">
        @csrf
        @method('PUT')
        <div class="form-group">
          <label for="nama_lengkap">Nama Lengkap Personel</label>
          <input readonly type="text" class="form-control @error('nama_lengkap') is-invalid @enderror" value="{{ old('nama_lengkap', $sisaCuti->personil->nama_lengkap)  }}" id="nama_lengkap" name="nama_lengkap" placeholder="Batas Cuti">
        </div>
        @error('nama_lengkap')
        <div class="alert alert-danger" role="alert">
            <p class="p-0 m-0">{{ $message }}</p>
        </div>
        @enderror

        <div class="form-group row">
            <label for="sisa_cuti" class="col-sm-2 col-form-label">Masukkan Jumlah Sisa Cuti Baru (Hari)</label>
            <div class="col-sm-4">
                <input type="number" class="form-control" id="sisa_cuti" name="sisa_cuti" placeholder="Masukkan Sisa Cuti Baru" value="{{ $sisaCuti->sisa_cuti }}">
            </div>
            @error('sisa_cuti')
            <div class="alert alert-danger" role="alert">
                <p class="p-0 m-0">{{ $message }}</p>
            </div>
            @enderror
            <label for="batas_cuti" class="col-sm-2 col-form-label">Masukkan Jumlah Batas Cuti Baru (Hari)</label>
            <div class="col-sm-4">
                <input type="number" class="form-control" id="batas_cuti" name="batas_cuti" placeholder="Masukkan Batas Cuti Baru" value="{{ $sisaCuti->batas_cuti }}">
            </div>
            @error('batas_cuti')
            <div class="alert alert-danger" role="alert">
                <p class="p-0 m-0">{{ $message }}</p>
            </div>
            @enderror
            
        </div>

        <div class="row jusitify-content-betwwen">
            <div class="col-md-6">
                <a href="{{ route('admin.sisa-cuti.index') }}" class="btn btn-light"><i class="bi bi-arrow-left"></i> Kembali</a>

            </div>
            <div class="col-md-6 text-right">
                <button type="submit" class="btn btn-primary">Submit <i class="bi bi-check-circle"></i></button>

            </div>
        </div>
    </form>    
</div>   
</div>
@endsection
