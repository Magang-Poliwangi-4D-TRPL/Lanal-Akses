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
                      <label for="password">Massukkan password akun personil baru</label>
                      <input type="text" class="form-control @error('password') is-invalid @enderror" id="password" name="password" value="{{ $personil->nrp}}" placeholder="Password Akun">
                      @error('password')
                          <div class="invalid-feedback">
                            {{ $message }}
                          </div>
                      @enderror
                    </div>
                    <div class="form-group">
                      <label for="role">Role personil baru</label>
                      <input type="text" class="form-control @error('role') is-invalid @enderror" id="role" name="role" value="personil" readonly=true placeholder="role Akun">
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

@endsection