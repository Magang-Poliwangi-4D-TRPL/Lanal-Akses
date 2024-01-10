@extends('layout.admin.app')

@section('title-page', 'Admin | Edit Jam Kerja')

@section('content')

<div class="container-fluid bg-white border rounded p-4 mt-4 ">
    <h4 style="text-transform: uppercase">Edit Jam kerja</h4>
    <form method="POST" action="">
        @csrf
        <div class="form-group row">
            <label for="jam_masuk_mulai" class="col-sm-2 col-form-label">Jam Masuk Mulai</label>
            <div class="col-sm-4">
                <div class="input-group">
                    <input type="text" class="form-control" name="jam_masuk_mulai" placeholder="00:00" value="{{ old('jam_masuk_mulai') }}">
                    <div class="input-group-append">
                        <div class="input-group-text"><i class="fa fa-clock"></i></div>
                    </div>
                </div>
              </div>
              @error('jam_masuk_mulai')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
              @enderror
            <label for="jam_masuk_selesai" class="col-sm-2 col-form-label">Jam Masuk Selesai</label>
            <div class="col-sm-4">
                <div class="input-group">
                    <input type="text" class="form-control" name="jam_masuk_selesai" placeholder="00:00" value="{{ old('jam_masuk_selesai') }}">
                    <div class="input-group-append">
                        <div class="input-group-text"><i class="fa fa-clock"></i></div>
                    </div>
                </div>
              </div>
              @error('jam_masuk_selesai')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
              @enderror
        </div>
        <div class="form-group row">
            <label for="jam_pulang_mulai" class="col-sm-2 col-form-label">Jam Pulang Mulai</label>
            <div class="col-sm-4">
                <div class="input-group">
                    <input type="text" class="form-control" name="jam_pulang_mulai" placeholder="00:00" value="{{ old('jam_pulang_mulai') }}">
                    <div class="input-group-append">
                        <div class="input-group-text"><i class="fa fa-clock"></i></div>
                    </div>
                </div>
              </div>
              @error('jam_pulang_mulai')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
              @enderror
            <label for="jam_pulang_selesai" class="col-sm-2 col-form-label">Jam Pulang Selesai</label>
            <div class="col-sm-4">
                <div class="input-group">
                    <input type="text" class="form-control" name="jam_pulang_selesai" placeholder="00:00" value="{{ old('jam_pulang_selesai') }}">
                    <div class="input-group-append">
                        <div class="input-group-text"><i class="fa fa-clock"></i></div>
                    </div>
                </div>
              </div>
              @error('jam_pulang_selesai')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
              @enderror
        </div>
        <div class="form-group">
            <label for="keterangan_jam_kerja">Massukkan keterangan jam kerja</label>
            <input type="area" class="form-control @error('keterangan_jam_kerja') is-invalid @enderror" id="keterangan_jam_kerja" name="keterangan_jam_kerja" value="{{ old('keterangan_jam_kerja')}}" placeholder="keterangan" autofocus>
            @error('keterangan_jam_kerja')
                <div class="invalid-feedback">
                  {{ $message }}
                </div>
            @enderror
          </div>
        <div class="pt-4 border-top border-black text-right">
            <button type="submit" class="btn btn-md btn-primary" style="text-transform: capitalize">Edit data jam kerja <i class="fa-solid fa-plus"></i></button>
        </div>
    </form>
</div>
@endsection
