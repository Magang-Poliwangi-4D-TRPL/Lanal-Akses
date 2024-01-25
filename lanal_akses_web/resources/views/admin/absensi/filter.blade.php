@extends('layout.admin.app')

@section('title-page', 'Admin | Filter Presensi')

@section('content')

<div class="container bg-white border rounded p-4 mt-4 ">
    <div class="container">
        <div class="container-fluid mb-4 border-bottom border-black">
            <h4 class="m-0 py-4" style="text-transform: uppercase">Cari Data absensi berdasarkan tanggal absensi</h4>
            @if(session('message'))
                    <div class="alert alert-warning">
                        {{ session('message') }}
                    </div>
                @endif
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
        </div>
        <form method="POST" action="{{ route('admin.absensi.filter.cari') }}">
            @csrf
            <div class="form-group">
                <div class="input-group date" id="datepicker">
                    <label class="col-md-4" for="tanggal_absensi">Massukkan tanggal absensi</label>
                    <input type="text" class="col-md-6 form-control @error('nama_lengkap') is-invalid @enderror" id="tanggal_absensi" data-target="#datepicker" name="tanggal_absensi" placeholder="tanggal absensi" value="{{ old('tanggal_absensi') }}">
                    <div class="input-group-append col-md-2" data-target="#datepicker" data-toggle="datetimepicker">
                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                    </div>
                </div>
            </div>
            <div class="row justify-content-between  border-top border-black">
                <div class="col-md-2 pt-4">
                    <a class="btn btn-md btn-secondary text-white" href="{{ route('admin.absensi.index') }}" style="text-transform: capitalize"><i class="fa-solid fa-arrow-left"></i> Kembali</a>
                </div>
                <div class="col-md-8  pt-4">
                    <button type="submit" class="btn btn-md btn-block btn-primary" style="text-transform: capitalize">Cari data <i style="font-size: 10pt" class="fa-solid fa-search"></i></button>
                </div>

            </div>
        </form>
    </div>
</div>
@endsection
