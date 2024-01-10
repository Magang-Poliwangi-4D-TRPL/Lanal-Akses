@extends('layout.admin.app')

@section('title-page', 'Admin | Tambah Jam Kerja Baru')

@section('content')

<div class="container bg-white border rounded p-4 mt-4 ">
    <div class="container">
        
        <h4 style="text-transform: uppercase">Tambah Jam kerja</h4>
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
            <div class="row justify-content-around  border-top border-black">
                <div class="pt-4 text-right">
                    <a class="btn btn-md btn-secondary text-white" href="{{ route('admin.absensi.index') }}" style="text-transform: capitalize"><i class="fa-solid fa-arrow-left"></i> Kembali</a>
                </div>
                <div class="pt-4 text-right">
                    <button type="submit" class="btn btn-md btn-primary" style="text-transform: capitalize">Tambah data jam kerja <i class="fa-solid fa-plus"></i></button>
                </div>

            </div>
        </form>
    </div>
</div>
@endsection
