@extends('layout.admin.app')

@section('title-page', 'Admin | Edit Data PNS')

@section('content')
    <div class="container">
        <div class="container">
            <h1 class="text-bold">Edit Data Pegawai</h1>
            <h4 class="mt-3">Ubah data pegawai</h4>

            {{-- Form Start --}}
            <div class="container bg-white border rounded p-5 mt-4">
                @php
                $nip = $pegawai->nip;
                $nipGanti = str_replace(' ', '-', $nip);
                @endphp
                <form method="POST" action="{{ route('admin.pegawai.update', ['nip' => $nipGanti]) }}">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                      <label for="nama_pegawai">Massukkan nama baru pegawai</label>
                      <input type="text" class="form-control @error('nama_pegawai') is-invalid @enderror" id="nama_pegawai" name="nama_pegawai" required autofocus placeholder="Nama Lengkap Pegawai" value="{{ $pegawai->nama_pegawai }}">
                      @error('nama_pegawai')
                          <div class="invalid-feedback">
                            {{ $message }}
                          </div>
                      @enderror
                    </div>
                    <div class="form-group">
                      <label for="jabatan">Massukkan jabatan baru pegawai</label>
                      <input type="text" class="form-control @error('jabatan') is-invalid @enderror" id="jabatan" name="jabatan" required placeholder="Jabatan pegawai" value="{{ $pegawai->jabatan }}">
                      @error('jabatan')
                          <div class="invalid-feedback">
                            {{ $message }}
                          </div>
                      @enderror
                    </div>
                    <div class="form-group">
                      <label for="golongan">Massukkan golongan pegawai baru</label>
                      <input type="text" class="form-control @error('golongan') is-invalid @enderror" id="golongan" name="golongan" required placeholder="Golongan pegawai" value="{{ $pegawai->golongan }}">
                      @error('golongan')
                          <div class="invalid-feedback">
                            {{ $message }}
                          </div>
                      @enderror
                    </div>
                    <div class="form-group">
                        <label for="email">Massukkan email (opsional)</label>
                        <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" placeholder="email" value="{{ $pegawai->email }}">
                        @error('email')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="form-group">
                      <label for="no_telepon">Massukkan nomor telepon pegawai baru</label>
                      <input type="text" class="form-control @error('no_telepon') is-invalid @enderror" id="no_telepon" name="no_telepon" required placeholder="nomor telepon pegawai" value="{{ $pegawai->no_telepon }}">
                      @error('no_telepon')
                          <div class="invalid-feedback">
                            {{ $message }}
                          </div>
                      @enderror
                    </div>
                    <div class="form-group">
                      <label for="alamat">Massukkan alamat pegawai baru</label>
                      <input type="text" class="form-control @error('alamat') is-invalid @enderror" id="alamat" name="alamat" required placeholder="Alamat pegawai" value="{{ $pegawai->alamat }}">
                      @error('alamat')
                          <div class="invalid-feedback">
                            {{ $message }}
                          </div>
                      @enderror
                    </div>
                    <a class="text-decoration-none btn btn-blue text-white bg-gray" href="{{ route('admin.pegawai.show', $nipGanti) }}">
                      <span><iconify-icon icon="ep:arrow-left"></iconify-icon></span>Kembali
                    </a>
                    <button type="submit" class="btn btn-primary">Update Data</button>
                </form>
                
            </div>
        </div>
        
    </div>

@endsection