@extends('layout.admin.app')

@section('title-page', 'Admin | Data Admin')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-greenmain text-white ">Tambah Admin</div>

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

                    <form method="POST" action="{{ route('users.store') }}">
                        @csrf
                        <div class="form-group">
                            <label for="nama_lengkap">Nama Lengkap:</label>
                            <input type="text" class="form-control" id="nama_lengkap" name="nama_lengkap" value="{{ old('nama_lengkap') }}" required>
                        </div>
                        <div class="form-group">
                            <label for="username">Username:</label>
                            <input type="text" class="form-control" id="username" name="username" value="{{ old('username') }}" required>
                        </div>
                        <div class="form-group">
                            <label for="password">Password:</label>
                            <div class="input-group">
                                <input type="password" class="form-control" id="password" name="password" required>
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
                                <option value="komandan">Komandan</option>
                                <option value="pasintel">Pasintel</option>
                                <option value="paspotmar">Paspotmar</option>
                                <option value="paset">Paset</option>
                                <option value="lain-lain">Lain-lain</option>
                                <!-- ... Bagian lain dari formulir ... -->
                            </select>
                        </div>
                        <div class="form-group">
                            <a href="{{ route('admin.users.index', ['page' => 1]) }}" class="btn btn-secondary">Kembali</a>
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
