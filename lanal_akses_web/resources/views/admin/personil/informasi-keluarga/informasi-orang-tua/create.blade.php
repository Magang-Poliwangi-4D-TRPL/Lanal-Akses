@extends('layout.admin.app')

@section('title-page', 'Tambah data orang tua')

@section('content')
    <div class="container">
        <div class="container">
            <div class="container text-center">
                <h1>Tambah data orang tua</h1>
            </div>

            {{-- Form Start --}}
            <div class="container bg-white border rounded p-5 mt-4">
                @php
                $nrp = $personil->nrp;
                $nrpGanti = str_replace('/', '-', $nrp);
                @endphp
                <form method="POST" action="{{ route('admin.personil.informasi-orang-tua.store', ['nrp' => $nrpGanti]) }}">
                    @csrf
                    <input type="hidden" name="personil_id" value="{{ $personil->id }}">
                    <div class="form-group">
                      <label for="nama_lengkap">Massukkan nama orang tua personel baru</label>
                      <input type="text" class="form-control @error('nama_lengkap') is-invalid @enderror" id="nama_lengkap" name="nama_lengkap" value="{{ old('nama_lengkap')}}" placeholder="Nama lengkap orang tua" autofocus>
                      @error('nama_lengkap')
                          <div class="invalid-feedback">
                            {{ $message }}
                          </div>
                      @enderror
                    </div>
                    <div class="form-group row">
                        
                        <label for="agama" class="col-sm-2 col-form-label">Agama</label>
                        <div class="col-sm-4">
                            <select class="form-control  @error('agama') is-invalid @enderror" name="agama" id="agama">
                                <option value="Islam" {{ old('agama',) === 'Islam' ? 'selected' : '' }}>Islam</option>
                                <option value="Krsiten" {{ old('agama',) === 'Krsiten' ? 'selected' : '' }}>Krsiten</option>
                                <option value="Katolik" {{ old('agama',) === 'Katolik' ? 'selected' : '' }}>Katolik</option>
                                <option value="Hindu" {{ old('agama',) === 'Hindu' ? 'selected' : '' }}>Hindu</option>
                                <option value="Buddha" {{ old('agama',) === 'Buddha' ? 'selected' : '' }}>Buddha</option>
                                <option value="Khonghucu" {{ old('agama',) === 'Khonghucu' ? 'selected' : '' }}>Khonghucu</option>
                            </select>
                            @error('agama')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        
                        <label for="status_hubungan" class="col-sm-2 col-form-label">Status Hubungan</label>
                        <div class="col-sm-4">
                            <select class="form-control  @error('status_hubungan') is-invalid @enderror" name="status_hubungan" id="status_hubungan">
                                <option value="Ayah Kandung" {{ old('status_hubungan',) === 'Ayah Kandung' ? 'selected' : '' }}>Ayah Kandung</option>
                                <option value="Ibu Kandung" {{ old('status_hubungan',) === 'Ibu Kandung' ? 'selected' : '' }}>Ibu Kandung</option>
                                <option value="Ayah Mertua" {{ old('status_hubungan',) === 'Ayah Mertua' ? 'selected' : '' }}>Ayah Mertua</option>
                                <option value="Ibu Mertua" {{ old('status_hubungan',) === 'Ibu Mertua' ? 'selected' : '' }}>Ibu Mertua</option>
                            </select>
                            @error('status_hubungan')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
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
    </div>
@endsection