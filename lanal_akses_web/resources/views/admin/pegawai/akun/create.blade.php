@extends('layout.admin.app')

@section('title-page', 'Pegawai | Buat Akun')

@section('content')
    <div class="container">
        <div class="container">
            <h1 class="text-bold">Membuat Akun Pegawai</h1>

            {{-- Form Start --}}
            <div class="container bg-white border rounded p-5 mt-4">
                @php
                $nip = $pegawai->nip;
                $nipGanti = str_replace(' ', '-', $nip);
                @endphp
                <form method="POST" action="{{ route('admin.pegawai.akun.store', ['nip' => str_replace(' ', '-', $nip)]) }}">
                    @csrf
                    <input type="hidden" name="pegawai_id" value="{{ $pegawai->id }}">
                    <div class="form-group">
                      <label for="nama_lengkap">Massukkan nama lengkap akun pegawai baru</label>
                      <input type="text" class="form-control @error('nama_lengkap') is-invalid @enderror" id="nama_lengkap" name="nama_lengkap" value="{{ $pegawai->nama_pegawai}}" placeholder="Nama Lengkap Akun" autofocus>
                      @error('nama_lengkap')
                          <div class="invalid-feedback">
                            {{ $message }}
                          </div>
                      @enderror
                    </div>
                    <div class="form-group">
                      <label for="username">Massukkan username akun pegawai baru</label>
                      <input type="text" class="form-control @error('username') is-invalid @enderror" id="username" name="username" value="{{ $pegawai->nip}}" placeholder="Username Akun">
                      @error('username')
                          <div class="invalid-feedback">
                            {{ $message }}
                          </div>
                      @enderror
                    </div>
                    <div class="form-group">
                      <label for="password">Password:</label>
                      <div class="input-group">
                          <input type="password" class="form-control" id="password" name="password" value="">
                          <div class="input-group-append">
                              <span class="input-group-text bg-secondary" id="show-password">
                                  <i class="far fa-eye text-light" id="eye-icon"></i>
                              </span>
                          </div>
                      </div>
                  </div>
                  <div class="form-group">
                      <label for="password_confirmation">Konfirmasi Password:</label>
                      <div class="input-group">
                          <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required>
                          <div class="input-group-append">
                              <span class="input-group-text bg-secondary" id="show-password-confirmation">
                                  <i class="far fa-eye text-light" id="eye-icon-confirmation"></i>
                              </span>
                          </div>
                      </div>
                  </div>
                    <div class="form-group">
                      <label for="role">Role pegawai baru</label>
                      <input type="text" class="form-control @error('role') is-invalid @enderror" id="role" name="role" value="pegawai" readonly=true placeholder="role Akun">
                      @error('role')
                          <div class="invalid-feedback">
                            {{ $message }}
                          </div>
                      @enderror
                    </div>
                    
                    <a class="text-decoration-none btn btn-blue text-white bg-gray" href="{{ route('admin.pegawai.akun.index', str_replace(' ', '-', $nip)) }}">
                      <span><iconify-icon icon="ep:arrow-left"></iconify-icon></span>Kembali
                    </a>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
        
    </div>
    <script src="{{ URL::asset('js/admin/visiblepassword.js'); }}"></script>

@endsection