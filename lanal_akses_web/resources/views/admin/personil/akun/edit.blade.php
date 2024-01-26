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

                    <form method="POST" action="{{ route('admin.personil.akun.update',['nrp' => str_replace('/', '-', $personil->nrp), 'akunId'=>$user[0]->id]) }}">
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
                            @if ($roles->count() > 0)
                                <select class="form-control  @error('role') is-invalid @enderror" name="role" id="role">
                                    @foreach ($roles as $role)
                                    <option value="{{ $role->name }}" {{ old('role', $user[0]->getRoleNames()->first()) === $role->name ? 'selected' : '' }}>{{ $role->name }}</option>
                                        
                                    @endforeach
                                </select>
                                @else
                                   <p>belum ada role</p> 
                                @endif
                        </div>
                        <div class="form-group">
                            <a href="{{ route('admin.personil.akun.index', str_replace('/', '-', $personil->nrp)) }}" class="btn btn-secondary">Kembali</a>
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
