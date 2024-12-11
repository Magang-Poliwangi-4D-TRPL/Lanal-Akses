@extends('layout.admin.app')

@section('title-page', 'Admin | Edit Nomor Surat')

@section('content')

<div class="container py-4">
    
    <div class="bg-white mb-5 overflow-hidden shadow-sm sm:rounded-lg">
        <div class="container py-4">

<!-- Pesan error global -->
@if ($errors->any())
<div class="alert alert-danger">
    <ul class="mb-0">
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

            <form method="POST" action="{{ route('admin.surat-cuti.sekretaris.updateNoSurat', $suratPengajuan->id) }}">
                @csrf
                @method('PUT')

                <!-- Nomor Surat -->
                <div class="form-group">
                    <h4>Edit Nomor Surat untuk Pengajuan Cuti {{ $suratPengajuan->personil->nama_lengkap }}</h4>
                    <label for="nomor_surat">Nomor Surat (--/--/--)</label>
                    <input class="form-control @error('nomor_surat') is-invalid @enderror" id="nomor_surat" name="nomor_surat" placeholder="Masukkan Nomor Surat" value="{{ old('name', $suratPengajuan->nomor_surat) }}">
                    @error('nomor_surat')
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
            </form>
            
        </div>
    </div>
</div>
@endsection