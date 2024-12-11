@extends('layout.admin.app')

@section('title-page', 'Admin | Edit Jenis Cuti')

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
    <h4 class="mt-3">Ubah Data Jenis Cuti</h4>
    <form method="POST" action="{{ route('admin.cuti.update',  $cuti->id) }}">
        @csrf
        @method('PUT')
        
        <div class="form-group">
            <label for="nama_cuti">Massukkan Nama Cuti <span class="text-danger">*</span></label>
            <input type="text" class="form-control @error('nama_cuti') is-invalid @enderror" value="{{ old('nama_cuti', $cuti->nama_cuti) }}" id="nama_cuti" name="nama_cuti" required placeholder="Nama Cuti">
          </div>
          @error('nama_cuti')
          <div class="alert alert-danger" role="alert">
              <p class="p-0 m-0">{{ $message }}</p>
          </div>
          @enderror
          <div class="form-group">
            <label for="kode_cuti">Massukkan Kode Cuti <span class="text-danger">*</span></label>
            <input type="text" class="form-control @error('kode_cuti') is-invalid @enderror" value="{{ old('kode_cuti', $cuti->kode_cuti) }}" id="kode_cuti" name="kode_cuti" required placeholder="CT-***">
            <small class="form-text mt-2 text-muted">Keterangan: tuliskan kode cuti dengan awalan CT-, contoh: CT-THN30</small>
          </div>
          @error('kode_cuti')
          <div class="alert alert-danger" role="alert">
              <p class="p-0 m-0">{{ $message }}</p>
          </div>
          @enderror
          <div class="form-group">
            <label for="jumlah_hari_cuti">Massukkan Jumlah Batasan Cuti (hari) <span class="text-danger">*</span></label>
            <input type="number" class="form-control @error('jumlah_hari_cuti') is-invalid @enderror" value="{{ old('jumlah_hari_cuti', $cuti->jumlah_hari_cuti) }}" id="jumlah_hari_cuti" name="jumlah_hari_cuti" required placeholder="Batas Cuti">
            <small class="form-text mt-2 text-muted">Keterangan: masukkan jumlah batas cuti dengan angka</small>
          </div>
          @error('jumlah_hari_cuti')
          <div class="alert alert-danger" role="alert">
              <p class="p-0 m-0">{{ $message }}</p>
          </div>
          @enderror
          <div class="form-group">
              <label for="deskripsi">Masukkan Deskripsi Cuti</label>
              <textarea rows="4" type="text" class="form-control @error('deskripsi') is-invalid @enderror" value="{{ old('deskripsi', $cuti->deskripsi) }}" id="deskripsi" name="deskripsi" placeholder="Deskripsi cuti">{{ old('deskripsi', $cuti->deskripsi) }}</textarea>
              
            </div>
            @error('deskripsi')
            <div class="alert alert-danger" role="alert">
                <p class="p-0 m-0">{{ $message }}</p>
            </div>
            @enderror
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
