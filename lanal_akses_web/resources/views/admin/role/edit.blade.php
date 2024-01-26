@extends('layout.admin.app')

@section('title-page', 'Admin | Data Role dan Permission')

@section('content')
<div class="container">
    <div class="bg-white mb-5 overflow-hidden shadow-sm sm:rounded-lg">
        <div class="container py-4">
            <form method="POST" action="{{ route('admin.role.update', ['idRole' => $role->id]) }}">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="name">Nama Role</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', $role->name) }}" required>
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="permissions">Pilih Permissions</label>
                    @foreach($permissions as $permission)
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="{{ $permission->name }}" name="permissions[]" value="{{ $permission->name }}" {{ in_array($permission->name, old('permissions', $role->permissions->pluck('name')->toArray())) ? 'checked' : '' }}>
                            <label class="form-check-label" for="{{ $permission->name }}">
                                {{ $permission->name }}
                            </label>
                        </div>
                    @endforeach
                    @error('permissions')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="btn btn-primary">Update Role</button>
            </form>   
        </div>    
    </div>  
</div>

@endsection