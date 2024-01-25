@extends('layout.admin.app')

@section('title-page', 'Admin | Data Akun Pegawai')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-greenmain text-white">Edit Akun Pegawai</div>

                <div class="card-body">
                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif

                    <form method="POST" action="{{ route('admin.pegawai.akun.update',['nip' => str_replace('-', ' ', $pegawai->nip), 'akunId'=>$user[0]->id]) }}">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="nama_lengkap">Nama Lengkap:</label>
                            <input type="text" class="form-control" id="nama_lengkap" name="nama_lengkap" value="{{ old('nama_lengkap', $user[0]->nama_lengkap) }}" required>
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
                            <label for="role">Role:</label>
                            <select class="form-control" id="role" name="role" required>
                                <!-- Opsi Role disini -->
                                <option value="komandan" {{ old('role', $user[0]->role) === 'komandan' ? 'selected' : '' }}>Komandan</option>
                                <option value="pasintel" {{ old('role', $user[0]->role) === 'pasintel' ? 'selected' : '' }}>Pasintel</option>
                                <option value="paspotmar" {{ old('role', $user[0]->role) === 'paspotmar' ? 'selected' : '' }}>Paspotmar</option>
                                <option value="paset" {{ old('role', $user[0]->role) === 'paset' ? 'selected' : '' }}>Paset</option>
                                <option value="personel" {{ old('role', $user[0]->role) === 'personel' ? 'selected' : '' }}>Personel</option>
                                <option value="pegawai" {{ old('role', $user[0]->role) === 'pegawai' ? 'selected' : '' }}>Pegawai</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <a href="{{ route('admin.pegawai.akun.index', str_replace('/', '-', $pegawai->nip)) }}" class="btn btn-secondary">Kembali</a>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="{{ URL::asset('js/admin/visiblepassword.js'); }}"></script>
@endsection
