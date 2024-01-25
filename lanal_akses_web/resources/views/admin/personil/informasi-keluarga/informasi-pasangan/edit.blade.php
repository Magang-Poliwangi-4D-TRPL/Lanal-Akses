@extends('layout.admin.app')

@section('title-page', 'Edit data pasangan')

@section('content')
    <div class="container">
        <div class="container">
            <div class="container text-center">
                <h1>Ubah data pasangan</h1>
            </div>

            {{-- Form Start --}}
            <div class="container bg-white border rounded p-5 mt-4">
                @php
                $nrp = $personil->nrp;
                $nrpGanti = str_replace('/', '-', $nrp);
                @endphp
                <form method="POST" action="{{ route('admin.personil.informasi-pasangan.update', ['nrp' => $nrpGanti, 'informasiPasanganId'=>$informasiPasangan->id]) }}">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                      <label for="nama_lengkap">Massukkan nama pasangan baru</label>
                      <input type="text" class="form-control @error('nama_lengkap') is-invalid @enderror" id="nama_lengkap" name="nama_lengkap" value="{{ old('nama_lengkap', $informasiPasangan->nama_lengkap)}}" placeholder="Nama lengkap pasangan" autofocus>
                      @error('nama_lengkap')
                          <div class="invalid-feedback">
                            {{ $message }}
                          </div>
                      @enderror
                    </div>
                    <div class="form-group row">
                        <label for="tempat_lahir" class="col-sm-2 col-form-label">Tempat Lahir</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" id="tempat_lahir" name="tempat_lahir" placeholder="Tempat Lahir" value="{{ old('tempat_lahir', $informasiPasangan->tempat_lahir) }}">
                        </div>
                        @error('tempat_lahir')
                          <div class="invalid-feedback">
                            {{ $message }}
                          </div>
                        @enderror
                        <label for="tanggal_lahir" class="col-sm-2 col-form-label">Tanggal Lahir</label>
                        <div class="col-sm-4">
                            <div class="input-group date" id="datepicker">
                                <input type="text" class="form-control" data-target="#datepicker" name="tanggal_lahir" placeholder="Tanggal Lahir" value="{{ old('tanggal_lahir', $informasiPasangan->tanggal_lahir) }}">
                                <div class="input-group-append" data-target="#datepicker" data-toggle="datetimepicker">
                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                </div>
                            </div>
                          </div>
                          @error('tanggal_lahir')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                          @enderror
                    </div>
                    <div class="form-group row">
                        <label for="agama" class="col-sm-2 col-form-label">Agama</label>
                        <div class="col-sm-4">
                            <select class="form-control  @error('agama') is-invalid @enderror" name="agama" id="agama">
                                <option value="Islam" {{ old('agama', $informasiPasangan->agama) === 'Islam' ? 'selected' : '' }}>Islam</option>
                                <option value="Krsiten" {{ old('agama', $informasiPasangan->agama) === 'Krsiten' ? 'selected' : '' }}>Krsiten</option>
                                <option value="Katolik" {{ old('agama', $informasiPasangan->agama) === 'Katolik' ? 'selected' : '' }}>Katolik</option>
                                <option value="Hindu" {{ old('agama', $informasiPasangan->agama) === 'Hindu' ? 'selected' : '' }}>Hindu</option>
                                <option value="Buddha" {{ old('agama', $informasiPasangan->agama) === 'Buddha' ? 'selected' : '' }}>Buddha</option>
                                <option value="Khonghucu" {{ old('agama', $informasiPasangan->agama) === 'Khonghucu' ? 'selected' : '' }}>Khonghucu</option>
                            </select>
                            @error('agama')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                          @enderror
                        </div>
                        <label for="suku_bangsa" class="col-sm-2 col-form-label">Suku Bangsa</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" id="suku_bangsa" name="suku_bangsa" placeholder="Suku Bangsa" value="{{ old('suku_bangsa', $informasiPasangan->suku_bangsa) }}">
                        </div>
                        @error('suku_bangsa')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group row">
                        <label for="tinggi_badan" class="col-sm-2 col-form-label">Tinggi badan</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" id="tinggi_badan" name="tinggi_badan" placeholder="00" value="{{ old('tinggi_badan', $informasiPasangan->tinggi_badan) }}">
                        </div>
                        @error('tinggi_badan')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                        <label for="berat_badan" class="col-sm-2 col-form-label">Berat badan</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" id="berat_badan" name="berat_badan" placeholder="00" value="{{ old('berat_badan', $informasiPasangan->berat_badan) }}">
                        </div>
                        @error('berat_badan')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group row">
                        <label for="golongan_darah" class="col-sm-3 col-form-label">Golongan darah pasangan</label>
                        <div class="col-sm-3">
                            <select class="form-control  @error('golongan_darah') is-invalid @enderror" name="golongan_darah" id="golongan_darah">
                                <option value="A+" {{ old('golongan_darah', $informasiPasangan->golongan_darah) === 'A+' ? 'selected' : '' }}>A+</option>
                                <option value="B+" {{ old('golongan_darah', $informasiPasangan->golongan_darah) === 'B+' ? 'selected' : '' }}>B+</option>
                                <option value="AB+" {{ old('golongan_darah', $informasiPasangan->golongan_darah) === 'AB+' ? 'selected' : '' }}>AB+</option>
                                <option value="O+" {{ old('golongan_darah', $informasiPasangan->golongan_darah) === 'O+' ? 'selected' : '' }}>O+</option>
                                <option value="A-" {{ old('golongan_darah', $informasiPasangan->golongan_darah) === 'A-' ? 'selected' : '' }}>A-</option>
                                <option value="B-" {{ old('golongan_darah', $informasiPasangan->golongan_darah) === 'B-' ? 'selected' : '' }}>B-</option>
                                <option value="AB-" {{ old('golongan_darah', $informasiPasangan->golongan_darah) === 'AB-' ? 'selected' : '' }}>AB-</option>
                                <option value="O-" {{ old('golongan_darah', $informasiPasangan->golongan_darah) === 'O-' ? 'selected' : '' }}>O-</option>
                            </select>
                            @error('golongan_darah')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="pekerjaan">Massukkan pekerjaan pasangan baru</label>
                        <input type="text" class="form-control @error('pekerjaan') is-invalid @enderror" id="pekerjaan" name="pekerjaan" value="{{ old('pekerjaan', $informasiPasangan->pekerjaan)}}" placeholder="Pekerjaan pasangan">
                        @error('pekerjaan')
                            <div class="invalid-feedback">
                              {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="alamat_sekarang">Massukkan alamat pasangan sekarang</label>
                        <input type="text" class="form-control @error('alamat_sekarang') is-invalid @enderror" id="alamat_sekarang" name="alamat_sekarang" value="{{ old('alamat_sekarang', $informasiPasangan->alamat_sekarang)}}" placeholder="Alamat pasangan sekarang">
                        @error('alamat_sekarang')
                            <div class="invalid-feedback">
                              {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="nomor_kpi">Massukkan nomor KPI pasangan baru</label>
                        <input type="text" class="form-control @error('nomor_kpi') is-invalid @enderror" id="nomor_kpi" name="nomor_kpi" value="{{ old('nomor_kpi', $informasiPasangan->nomor_kpi)}}" placeholder="nomor KPI pasangan">
                        @error('nomor_kpi')
                            <div class="invalid-feedback">
                              {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="nomor_surat_nikah">Massukkan nomor surat nikah pasangan baru</label>
                        <input type="text" class="form-control @error('nomor_surat_nikah') is-invalid @enderror" id="nomor_surat_nikah" name="nomor_surat_nikah" value="{{ old('nomor_surat_nikah', $informasiPasangan->nomor_surat_nikah)}}" placeholder="nomor surat nikah pasangan">
                        @error('nomor_surat_nikah')
                            <div class="invalid-feedback">
                              {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="tempat_nikah">Massukkan tempat nikah pasangan baru</label>
                        <input type="text" class="form-control @error('tempat_nikah') is-invalid @enderror" id="tempat_nikah" name="tempat_nikah" value="{{ old('tempat_nikah', $informasiPasangan->tempat_nikah)}}" placeholder="tempat nikah pasangan">
                        @error('tempat_nikah')
                            <div class="invalid-feedback">
                              {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="nomor_kta_jalasenastri">Massukkan KTA JALASENASTRI pasangan baru</label>
                        <input type="text" class="form-control @error('nomor_kta_jalasenastri') is-invalid @enderror" id="nomor_kta_jalasenastri" name="nomor_kta_jalasenastri" value="{{ old('nomor_kta_jalasenastri', $informasiPasangan->nomor_kta_jalasenastri)}}" placeholder="No. KTA JASALASENASTRI pasangan">
                        @error('nomor_kta_jalasenastri')
                            <div class="invalid-feedback">
                              {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="pt-4 border-top border-black">
                        <a class="text-decoration-none btn btn-blue text-white bg-gray" href="{{ route('admin.personil.informasi-keluarga.index', $nrpGanti) }}">
                            <span><iconify-icon icon="ep:arrow-left"></iconify-icon></span>Kembali
                        </a>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    @endsection