@extends('layout.admin.app')

@section('title-page', 'Personil | Edit Data Sanksi Hukuman Personil')

@section('content')
    <div class="container">
        <div class="container">
            <h1 class="text-bold">Edit Data Sanksi Hukuman</h1>
            <h4 class="mt-3">Ubah data sanksi hukuman personil</h4>

            {{-- Form Start --}}
            <div class="container bg-white border rounded p-5 mt-4">
                @php
                $nrp = $personil->nrp;
                $nrpGanti = str_replace('/', '-', $nrp);
                @endphp
                {{--  --}}
                <form method="POST" action="{{ route('admin.personil.sanksi-hukuman.update', ['nrp' => $nrpGanti, 'sanksiHukumanId' => $sanksiHukuman->id]) }}">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="personil_id" value="{{ $personil->id }}">
                    <div class="form-group">
                      <label for="nama_hukuman">Massukkan nama sanksi hukuman baru</label>
                      <input type="text" class="form-control @error('nama_hukuman') is-invalid @enderror" id="nama_hukuman" name="nama_hukuman" required autofocus placeholder="Nama sanksi hukuman" value="{{ $sanksiHukuman->nama_hukuman }}">
                      @error('nama_hukuman')
                          <div class="invalid-feedback">
                            {{ $message }}
                          </div>
                      @enderror
                    </div>
                    <div class="form-group">
                      <label for="tahun_hukuman">Massukkan Tahun Hukuman baru</label>
                      <input type="text" class="form-control @error('tahun_hukuman') is-invalid @enderror" id="tahun_hukuman" name="tahun_hukuman" required placeholder="YYYY" value="{{ $sanksiHukuman->tahun_hukuman }}">
                      @error('tahun_hukuman')
                          <div class="invalid-feedback">
                            {{ $message }}
                          </div>
                      @enderror
                    </div>
                    <div class="form-group">
                      <label for="keterangan">Massukkan keterangan (opsional)</label>
                      <input type="text" class="form-control @error('keterangan') is-invalid @enderror" id="keterangan" name="keterangan" required placeholder="Keterangan" value="{{ $sanksiHukuman->keterangan }}">
                      @error('keterangan')
                          <div class="invalid-feedback">
                            {{ $message }}
                          </div>
                      @enderror
                    </div>
                    <a class="text-decoration-none btn btn-blue text-white bg-gray" href="{{ route('admin.personil.sanksi-hukuman.index', $nrpGanti) }}">
                      <span><iconify-icon icon="ep:arrow-left"></iconify-icon></span>Kembali
                    </a>
                    <button type="submit" class="btn btn-primary">Update Data</button>
                </form>
                
            </div>
        </div>
        
    </div>

@endsection