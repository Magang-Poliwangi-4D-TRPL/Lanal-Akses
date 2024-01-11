@extends('layout.admin.app')

@section('title-page', 'Admin | Tambah Jam Kerja Baru')

@section('content')

<div class="container bg-white border rounded p-4 mt-4 ">
    <div class="container">
        
        <h4 style="text-transform: uppercase">Tambah Jam kerja</h4>
        <p>Catatan: setiap tanda (<span class="text-danger">*</span>) pada form memiliki arti form tersbeut wajib diisi</p>
        <form method="POST" action="{{ route('admin.absensi.data-jam-kerja.store') }}">
            @csrf
            <div class="form-group mt-4">
                <label for="nama_waktu_kerja">Masukkan Judul/Nama Waktu Kerja <span class="text-danger">*</span></label>
                <input type="text" class="form-control @error('nama_waktu_kerja') is-invalid @enderror" id="nama_waktu_kerja" name="nama_waktu_kerja" value="{{ old('nama_waktu_kerja')}}" placeholder="contoh: Informasi kerja seluruh personil & pegawai LANAL BWI" autofocus>
                @error('nama_waktu_kerja')
                    <div class="invalid-feedback">
                      {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="form-group  mt-4 row">
                <label for="jam_masuk_mulai" class="col-sm-2 col-form-label">Jam Masuk Mulai <span class="text-danger">*</span></label>
                <div class="col-sm-4">
                    <div class="input-group">
                        <input type="time" class="form-control" name="jam_masuk_mulai" placeholder="00:00" value="{{ old('jam_masuk_mulai') }}">
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
                <label for="jam_masuk_selesai" class="col-sm-2 col-form-label">Batas Jam Masuk <span class="text-danger">*</span></label>
                <div class="col-sm-4">
                    <div class="input-group">
                        <input type="time" class="form-control" name="jam_masuk_selesai" placeholder="00:00" value="{{ old('jam_masuk_selesai') }}">
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
                <label for="jam_pulang_mulai" class="col-sm-2 col-form-label">Jam Pulang Mulai <span class="text-danger">*</span></label>
                <div class="col-sm-4">
                    <div class="input-group">
                        <input type="time" class="form-control" name="jam_pulang_mulai" placeholder="00:00" value="{{ old('jam_pulang_mulai') }}">
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
                <label for="jam_pulang_selesai" class="col-sm-2 col-form-label">Batas Jam Pulang <span class="text-danger">*</span></label>
                <div class="col-sm-4">
                    <div class="input-group">
                        <input type="time" class="form-control" name="jam_pulang_selesai" placeholder="00:00" value="{{ old('jam_pulang_selesai') }}">
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
            <h5 class="mt-4">Informasi Tambahan (tidak wajib diisi)</h5>
            <div class="form-group row mt-4">
                <label for="jam_istirahat_mulai" class="col-sm-2 col-form-label">Jam istirahat Mulai</label>
                <div class="col-sm-4">
                    <div class="input-group">
                        <input type="time" class="form-control" name="jam_istirahat_mulai" placeholder="00:00" value="{{ old('jam_istirahat_mulai') }}">
                        <div class="input-group-append">
                            <div class="input-group-text"><i class="fa fa-clock"></i></div>
                        </div>
                    </div>
                  </div>
                  @error('jam_istirahat_mulai')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                  @enderror
                <label for="jam_istirahat_selesai" class="col-sm-2 col-form-label">Batas Jam istirahat </label>
                <div class="col-sm-4">
                    <div class="input-group">
                        <input type="time" class="form-control" name="jam_istirahat_selesai" placeholder="00:00" value="{{ old('jam_istirahat_selesai') }}">
                        <div class="input-group-append">
                            <div class="input-group-text"><i class="fa fa-clock"></i></div>
                        </div>
                    </div>
                  </div>
                  @error('jam_istirahat_selesai')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                  @enderror
            </div>
            <div class="form-group mt-4">
                <label for="keterangan">Masukkan keterangan jam kerja</label>
                <input type="area" class="form-control @error('keterangan') is-invalid @enderror" id="keterangan" name="keterangan" value="{{ old('keterangan')}}" placeholder="keterangan">
                @error('keterangan')
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
