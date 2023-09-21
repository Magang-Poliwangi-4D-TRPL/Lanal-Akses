@extends('layout.admin.app')

@section('title-page', 'Admin | Data Admin')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-greenmain text-white">Edit Admin</div>

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

                    <form method="POST" action="{{ route('users.update', $user->id) }}">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="nama_lengkap">Nama Lengkap:</label>
                            <input type="text" class="form-control" id="nama_lengkap" name="nama_lengkap" value="{{ old('nama_lengkap', $user->nama_lengkap) }}" required>
                        </div>
                        <div class="form-group">
                            <label for="username">Username:</label>
                            <input type="text" class="form-control" id="username" name="username" value="{{ old('username', $user->username) }}" required>
                        </div>
                        <div class="form-group">
                            <label for="password">Password:</label>
                            <div class="input-group">
                                <input type="password" class="form-control" id="password" name="password">
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
                            <select class="form-select" id="role" name="role" required>
                                <!-- Opsi Role disini -->
                                <!-- ... Bagian lain dari formulir ... -->
                                <option value="komandan" {{ old('role', $user->role) === 'komandan' ? 'selected' : '' }}>Komandan</option>
                                <option value="pasintel" {{ old('role', $user->role) === 'pasintel' ? 'selected' : '' }}>Pasintel</option>
                                <option value="paspotmar" {{ old('role', $user->role) === 'paspotmar' ? 'selected' : '' }}>Paspotmar</option>
                                <option value="paset" {{ old('role', $user->role) === 'paset' ? 'selected' : '' }}>Paset</option>
                                <option value="lain-lain" {{ old('role', $user->role) === 'lain-lain' ? 'selected' : '' }}>Lain-lain</option>
                                <!-- ... Bagian lain dari formulir ... -->
                            </select>
                        </div>
                        <div class="form-group">
                            <a href="{{ route('users.index') }}" class="btn btn-secondary">Kembali</a>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
