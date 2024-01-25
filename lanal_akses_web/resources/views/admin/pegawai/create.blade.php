@extends('layout.admin.app')

@section('title-page', 'Admin | Tambah Pegawai')

@section('content')
    <div class="container">
        <div class="container">
            @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
          @endif
            <h1 class="text-bold">Tambah Data Pegawai</h1>
            <h4 class="mt-3">Tambahkan Data Pegawai Baru</h4>

            {{-- Form Start --}}
            <div class="container bg-white border rounded p-5 mt-4">
                <form method="POST" action="{{ route('admin.pegawai.store') }}">
                    @csrf
                    <div class="form-group">
                      <label for="nama_pegawai">Massukkan nama lengkap pegawai baru</label>
                      <input type="text" class="form-control" id="nama_pegawai" name="nama_pegawai" required placeholder="Nama Lengkap">
                    </div>
                    <div class="form-group">
                      <label for="nip">Massukkan NIP pegawai baru</label>
                      <input type="text" class="form-control" id="nip" name="nip" required placeholder="12345678">
                    </div>
                    <div class="form-group">
                      <label for="jabatan">Massukkan jabatan pegawai baru</label>
                      <input type="text" class="form-control" id="jabatan" name="jabatan" required placeholder="Jabatan Pegawai">
                    </div>
                    <div class="form-group">
                      <label for="golongan">Massukkan golongan pegawai baru</label>
                      <input type="text" class="form-control" id="golongan" name="golongan" required placeholder="Golongan Pegawai">
                    </div>
                    <div class="form-group row">
                      <label for="jenis_kelamin" class="col-sm-2 col-form-label">Jenis Kelamin</label>
                      <div class="col-sm-4">
                          <select class="form-control  @error('jenis_kelamin') is-invalid @enderror" name="jenis_kelamin" id="jenis_kelamin">
                              <option value="L" {{ old('jenis_kelamin',) === 'L' ? 'selected' : '' }}>Laki-Laki</option>
                              <option value="P" {{ old('jenis_kelamin',) === 'P' ? 'selected' : '' }}>Perempuan</option>
                          </select>
                          @error('jenis_kelamin')
                          <div class="invalid-feedback">
                              {{ $message }}
                          </div>
                        @enderror
                      </div>
                  </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
                
            </div>
        </div>
        
    </div>

@endsection