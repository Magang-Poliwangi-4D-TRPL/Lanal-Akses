@extends('layout.admin.app')

@section('title-page', 'Admin | Edit Presensi Anggota')

@section('content')
<div class="container-fluid bg-white border rounded p-4 mt-4 ">
    <div class="container">
        <div class="container py-4 row justify-content-between">
            <div class="col-md-8">
                <h2>Edit Data Absensi Anggota</h2>
            </div>
            <div class="col-md-4 d-flex justify-content-end">
                <a href="{{  url()->previous() }}" class="btn btn-light btn-lg"><li style="font-size:10pt" class="mr-1 fa-solid fa-arrow-left"></li> Kembali</a>
            </div>
        </div>
    </div>
</div>
<div class="container-fluid bg-white border rounded p-4 mt-4 ">
    <div class="container">
        <div class="container border-bottom border-black py-4">
            <div class="row d-flex justify-content-between align-item-center">
                <div class="col-md-6">
                    @empty($detailPresensiAnggota->personil_id)
                        <h4>{{ $detailPresensiAnggota->pegawai->nama_pegawai }}</h4>
                    @else
                        <h4>{{ $detailPresensiAnggota->personil->nama_lengkap }}</h4>
                    @endEmpty
                </div>
                <div class="col-md-6 text-right">
                    <h4>{{ $detailPresensiAnggota->tanggal_kehadiran }}</h4>
                </div>
            </div>
        </div>
        <div class="container">
            <form method="POST" action="{{ route('admin.absensi.update', ['idKehadiran' => $detailPresensiAnggota->id]) }}">
                @csrf
                @method("PUT")
                <div class="form-group  mt-4 row">
                    <label for="jam_masuk" class="col-sm-3 col-form-label">Masukkan Jam Masuk Anggota <span class="text-danger">*</span></label>
                    <div class="col-sm-3">
                        <div class="input-group">
                            <input type="time" class="form-control" name="jam_masuk" placeholder="00:00" value="{{ old('jam_masuk', $detailPresensiAnggota->jam_masuk) }}">
                            <div class="input-group-append">
                                <div class="input-group-text"><i class="fa fa-clock"></i></div>
                            </div>
                        </div>
                      </div>
                      @error('jam_masuk')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                      @enderror
                    <label for="jam_pulang" class="col-sm-3 col-form-label">Masukkan Jam Pulang Anggota</label>
                    <div class="col-sm-3">
                        <div class="input-group">
                            <input type="time" class="form-control" name="jam_pulang" placeholder="00:00" value="{{ old('jam_pulang', $detailPresensiAnggota->jam_pulang) }}">
                            <div class="input-group-append">
                                <div class="input-group-text"><i class="fa fa-clock"></i></div>
                            </div>
                        </div>
                      </div>
                      @error('jam_pulang')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                      @enderror
                </div>
                <div class="form-group mt-4">
                    <div class="row justify-content-between">
                        <label class="col-sm-6 col-form-label" for="lokasi">Lokasi Presensi Anggota</label>
                        <label class="col-sm-6 col-form-label" for="lokasi">Lokasi default Lanal BWI: -8.137807,114.4005344</label>
                    </div>
                    <input type="area" class="form-control @error('lokasi') is-invalid @enderror" id="lokasi" name="lokasi" value="{{ old('lokasi', $detailPresensiAnggota->lokasi)}}" placeholder="lat, long">
                    @error('lokasi')
                        <div class="invalid-feedback">
                          {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="form-group row">
                    <label for="status_kehadiran" class="col-sm-3 col-form-label">Status Kehadiran Anggota  <span class="text-danger">*</span></label>
                    <div class="col-sm-3">
                        <select class="form-control  @error('status_kehadiran') is-invalid @enderror" name="status_kehadiran" id="status_kehadiran">
                            <option value="Hadir" {{ old('status_kehadiran', $detailPresensiAnggota->status_kehadiran) === 'Hadir' ? 'selected' : '' }}>Hadir</option>
                            <option value="Ijin" {{ old('status_kehadiran', $detailPresensiAnggota->status_kehadiran) === 'Ijin' ? 'selected' : '' }}>Ijin</option>
                            <option value="Belum Absen" {{ old('status_kehadiran', $detailPresensiAnggota->status_kehadiran) === 'Belum Absen' ? 'selected' : '' }}>Belum Absen</option>
                            <option value="Terlambat" {{ old('status_kehadiran', $detailPresensiAnggota->status_kehadiran) === 'Terlambat' ? 'selected' : '' }}>Terlambat</option>
                            <option value="Tidak Hadir" {{ old('status_kehadiran', $detailPresensiAnggota->status_kehadiran) === 'Tidak Hadir' ? 'selected' : '' }}>Tidak Hadir</option>
                        </select>
                        @error('status_kehadiran')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                    </div>
                    <label for="keterangan" class="col-sm-3 col-form-label">Keterangan Presensi Anggota</label>
                    <input type="area" class="form-control col-sm-3 @error('keterangan') is-invalid @enderror" id="keterangan" name="keterangan" value="{{ old('keterangan', $detailPresensiAnggota->keterangan)}}" placeholder="keterangan">
                        @error('keterangan')
                            <div class="invalid-feedback">
                            {{ $message }}
                            </div>
                        @enderror
                </div>

                <div class="row justify-content-end  border-top border-black">
                    <div class="pt-4 text-right">
                        <button type="submit" class="btn btn-md btn-primary bg-bluedark" style="text-transform: capitalize">Update data presensi <i class="fa-solid fa-check"></i></button>
                    </div>
    
                </div>
            </form>
        </div>
    </div>
</div>
@endsection