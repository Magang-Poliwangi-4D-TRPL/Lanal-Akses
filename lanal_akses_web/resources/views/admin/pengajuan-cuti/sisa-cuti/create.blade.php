@extends('layout.admin.app')

@section('title-page', 'Admin | Batas Hari Cuti')

@section('content')
<div class="container">
<div class="container bg-white py-4">

    <form method="POST" action="{{ route('admin.sisa-cuti.store') }}">
        @csrf
        <div class="form-group">
          <label for="batas_cuti">Massukkan Jumlah Batasan Cuti (hari)</label>
          <input type="number" class="form-control @error('batas_cuti') is-invalid @enderror" value="{{ old('batas_cuti') }}" id="batas_cuti" name="batas_cuti" required placeholder="Batas Cuti">
          <small class="form-text mt-2 text-muted">Keterangan: masukkan jumlah batas cuti dengan angka 1-10</small>
        </div>
        @error('batas_cuti')
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
