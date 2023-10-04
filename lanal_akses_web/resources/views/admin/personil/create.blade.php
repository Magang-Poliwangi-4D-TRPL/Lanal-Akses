@extends('layout.admin.app')

@section('title-page', 'Admin | Tambah Personil')

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
            <h1 class="text-bold">Tambah Data Personil</h1>
            <h4 class="mt-3">Tambahkan Data Personil Baru</h4>

            {{-- Form Start --}}
            <div class="container bg-white border rounded p-5 mt-4">
                <form method="POST" action="{{ route('admin.personil.store') }}">
                    @csrf
                    <div class="form-group">
                      <label for="nama_lengkap">Massukkan nama lengkap personil baru</label>
                      <input type="text" class="form-control" id="nama_lengkap" name="nama_lengkap" required placeholder="Nama Lengkap">
                    </div>
                    <div class="form-group">
                      <label for="nrp">Massukkan NRP/KORPS personil baru</label>
                      <input type="text" class="form-control" id="nrp" name="nrp" required placeholder="12345A/A">
                    </div>
                    <div class="form-group">
                      <label for="jabatan">Massukkan jabatan personil baru</label>
                      <input type="text" class="form-control" id="jabatan" name="jabatan" required placeholder="Jabatan Personil">
                    </div>
                    <div class="form-group">
                      <label for="jenis_kelamin">Massukkan jenis kelamin personil baru</label>
                      <select class="form-control" name="jenis_kelamin">
                        <option value="L">Laki - Laki</option>
                        <option value="P">Perempuan</option>
                      </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
                
            </div>
        </div>
        
    </div>

@endsection