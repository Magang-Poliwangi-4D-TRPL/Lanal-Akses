@extends('layout.admin.app')

@section('title-page', 'Admin | Data PNS')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-greenmain text-white">Edit Pegawai PNS</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('pegawai.update', $pegawai->id) }}">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="nip">NIP:</label>
                            <input type="text" class="form-control" value="{{ $pegawai->nip }}" readonly>
                        </div>
                        <div class="form-group">
                            <label for="nama_pegawai">Nama Pegawai:</label>
                            <input type="text" name="nama_pegawai" class="form-control @error('nama_pegawai') is-invalid @enderror" value="{{ $pegawai->nama_pegawai }}">
                            @error('nama_pegawai')
                                <span class="invalid-feedback" role="alert">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="jabatan">Jabatan:</label>
                            <input type="text" name="jabatan" class="form-control @error('jabatan') is-invalid @enderror" value="{{ $pegawai->jabatan }}">
                            @error('jabatan')
                                <span class="invalid-feedback" role="alert">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="golongan">Golongan:</label>
                            <input type="text" name="golongan" class="form-control @error('golongan') is-invalid @enderror" value="{{ $pegawai->golongan }}">
                            @error('golongan')
                                <span class="invalid-feedback" role="alert">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                        <a href="{{ route('pegawai.index') }}" class="btn btn-secondary">Kembali</a>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
