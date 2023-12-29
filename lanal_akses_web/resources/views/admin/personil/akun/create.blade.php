@extends('layout.admin.app')

@section('title-page', 'Personil | Buat Akun')

@section('content')
    <div class="container">
        <div class="container">
            <h1 class="text-bold">Membuat Akun Personil</h1>

            {{-- Form Start --}}
            <div class="container bg-white border rounded p-5 mt-4">
                @php
                $nrp = $personil->nrp;
                $nrpGanti = str_replace('/', '-', $nrp);
                @endphp
                <form method="POST" action="{{ route('admin.personil.akun.store', ['nrp' => str_replace('/', '-', $nrp)]) }}">
                    @csrf
                    <input type="hidden" name="personil_id" value="{{ $personil->id }}">
                    <div class="form-group">
                      <label for="nama_lengkap">Massukkan nama lengkap akun personil baru</label>
                      <input type="text" class="form-control @error('nama_lengkap') is-invalid @enderror" id="nama_lengkap" name="nama_lengkap" value="{{ $personil->nama_lengkap}}" placeholder="Nama Lengkap Akun" autofocus>
                      @error('nama_lengkap')
                          <div class="invalid-feedback">
                            {{ $message }}
                          </div>
                      @enderror
                    </div>
                    <div class="form-group">
                      <label for="username">Massukkan username akun personil baru</label>
                      <input type="text" class="form-control @error('username') is-invalid @enderror" id="username" name="username" value="{{ $personil->nrp}}" placeholder="Username Akun">
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
                      <label for="role">Role personil baru</label>
                      <input type="text" class="form-control @error('role') is-invalid @enderror" id="role" name="role" value="personel" readonly=true placeholder="role Akun">
                      @error('role')
                          <div class="invalid-feedback">
                            {{ $message }}
                          </div>
                      @enderror
                    </div>
                    
                    <a class="text-decoration-none btn btn-blue text-white bg-gray" href="{{ route('admin.personil.akun.index', str_replace('/', '-', $nrp)) }}">
                      <span><iconify-icon icon="ep:arrow-left"></iconify-icon></span>Kembali
                    </a>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
        
    </div>
    <script src="{{ URL::asset('js/admin/visiblepassword.js'); }}"></script>

@endsection