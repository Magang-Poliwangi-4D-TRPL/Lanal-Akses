@extends('layout.admin.app')

@section('title-page', 'Admin | Batas Hari Cuti')

@section('content')
<div class="container">
<div class="container bg-white py-4">
    @if (Session::get('alert'))
            <div class="alert alert-danger">
                {{ Session::get('alert') }}
            </div>
        @endif
    
        @if (Session::get('success'))
            <div class="alert alert-success">
                {{ Session::get('success') }}
            </div>
        @endif
    
        @if (Session::get('warning'))
            <div class="alert alert-warning">
                {{ Session::get('warning') }}
            </div>
        @endif
    
        @if (Session::get('error'))
            <div class="alert alert-danger">
                {{ Session::get('error') }}
            </div>
        @endif
    @empty($suratPengajuan->dataCutiPersonel->id)
        <h4 class="mt-3">Ubah Data Pengajuan Cuti {{ $suratPengajuan->dataCutiPegawai->pegawai->nama_pegawai }}</h4>
    @else
        <h4 class="mt-3">Ubah Data Pengajuan Cuti {{ $suratPengajuan->dataCutiPersonel->personil->nama_lengkap }}</h4>
    @endempty
    <form method="POST" action="{{ route('admin.surat-cuti.update',  $suratPengajuan->id) }}">
        @csrf
        @method('PUT')

        <!-- Pilih Atasan (dengan searchbar) -->
        <div class="form-group">
            <label for="atasan_id">Pilih Atasan</label>
            <select class="form-control select2 @error('atasan_id') is-invalid @enderror" id="atasan_id" name="atasan_id" required>
                <option value="">Cari dan pilih atasan</option>
                @foreach($atasanList as $atasan)
                    <option value="{{ $atasan->id }}">{{ $atasan->nama_lengkap }} ({{ $atasan->nrp }})</option>
                @endforeach
            </select>
            @error('atasan_id')
            <div class="alert alert-danger" role="alert">
                <p class="p-0 m-0">{{ $message }}</p>
            </div>
            @enderror
        </div>

        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="tanggal_mulai_cuti">Tanggal Mulai Cuti</label>
                <input type="date" class="form-control @error('tanggal_mulai_cuti') is-invalid @enderror" value="{{ old('tanggal_mulai_cuti') }}" id="tanggal_mulai_cuti" name="tanggal_mulai_cuti" required>
                @error('tanggal_mulai_cuti')
                <div class="alert alert-danger" role="alert">
                    <p class="p-0 m-0">{{ $message }}</p>
                </div>
                @enderror
            </div>
        
            <div class="form-group col-md-6">
                <label for="tanggal_selesai_cuti">Tanggal Selesai Cuti</label>
                <input type="date" class="form-control @error('tanggal_selesai_cuti') is-invalid @enderror" value="{{ old('tanggal_selesai_cuti') }}" id="tanggal_selesai_cuti" name="tanggal_selesai_cuti" required>
                @error('tanggal_selesai_cuti')
                <div class="alert alert-danger" role="alert">
                    <p class="p-0 m-0">{{ $message }}</p>
                </div>
                @enderror
            </div>
        </div>

        <div class="form-group">
            <label for="jenis_cuti">Jenis Cuti</label>
            <select class="form-control @error('jenis_cuti') is-invalid @enderror" id="jenis_cuti" name="jenis_cuti" required>
            @foreach ($dataCuti as $cuti)
                <option value="{{ $cuti->kode_cuti }}" {{ old('jenis_cuti') == $cuti->kode_cuti ? 'selected' : '' }}>{{ ' [' . $cuti->kode_cuti.'] ' .$cuti->nama_cuti . ' - batas jumlah cuti : ' . $cuti->jumlah_hari_cuti }}</option>
            @endforeach
            </select>
            @error('jenis_cuti')
            <div class="alert alert-danger" role="alert">
                <p class="p-0 m-0">{{ $message }}</p>
            </div>
            @enderror
        </div>
    
        <div class="form-group">
            <label for="no_telepon">Nomor Telepon Yang Bisa Dihubungi Saat Cuti</label>
            <input type="text" class="form-control @error('no_telepon') is-invalid @enderror" value="{{ old('no_telepon') }}" id="no_telepon" name="no_telepon" required placeholder="Masukkan nomor telepon">
            @error('no_telepon')
            <div class="alert alert-danger" role="alert">
                <p class="p-0 m-0">{{ $message }}</p>
            </div>
            @enderror
        </div>
    
        <div class="form-group">
            <label for="alamat_cuti">Alamat Selama Cuti</label>
            <input type="text" class="form-control @error('alamat_cuti') is-invalid @enderror" value="{{ old('alamat_cuti') }}" id="alamat_cuti" name="alamat_cuti" placeholder="Masukkan alamat selama cuti">
            @error('alamat_cuti')
            <div class="alert alert-danger" role="alert">
                <p class="p-0 m-0">{{ $message }}</p>
            </div>
            @enderror
        </div>
        
        <div class="form-group">
            <label for="alasan_cuti">Alasan Cuti</label>
            <textarea class="form-control @error('alasan_cuti') is-invalid @enderror" id="alasan_cuti" name="alasan_cuti" rows="3" placeholder="Masukkan alasan cuti">{{ old('alasan_cuti') }}</textarea>
            @error('alasan_cuti')
            <div class="alert alert-danger" role="alert">
                <p class="p-0 m-0">{{ $message }}</p>
            </div>
            @enderror
        </div>

        <!-- Keterangan -->
        <div class="form-group">
            <label for="keterangan">Keterangan</label>
            <textarea class="form-control @error('keterangan') is-invalid @enderror" id="keterangan" name="keterangan" rows="3" placeholder="Masukkan keterangan tambahan">{{ old('keterangan') }}</textarea>
            @error('keterangan')
            <div class="alert alert-danger" role="alert">
                <p class="p-0 m-0">{{ $message }}</p>
            </div>
            @enderror
        </div>
    
        <div class="row justify-content-between">
            <div class="col-md-6">
                <a href="{{ route('dashboard') }}" class="btn btn-light"><i class="bi bi-arrow-left"></i> Kembali</a>
            </div>
            <div class="col-md-6 text-right">
                <button type="submit" class="btn btn-primary">Submit <i class="bi bi-check-circle"></i></button>
            </div>
        </div>

        <div class="row jusitify-content-betwwen">
            <div class="col-md-6">
                <a href="{{ url()->previous() }}" class="btn btn-light"><i class="bi bi-arrow-left"></i> Kembali</a>

            </div>
            <div class="col-md-6 text-right">
                <button type="submit" class="btn btn-primary">Submit <i class="bi bi-check-circle"></i></button>

            </div>
        </div>
    </form>    
</div>   
</div>
@endsection
