@extends('layout.admin.app')

@section('title-page', 'Personil | Tambah Data Kepangkatan Personil')

@section('content')
    <div class="container">
        <div class="container">
            <h1 class="text-bold">Tambah Data Kepangkatan</h1>
            <h4 class="mt-3">Tambahkan data kepangkatan personil baru</h4>

            {{-- Form Start --}}
            <div class="container bg-white border rounded p-5 mt-4">
                @php
                $nrp = $personil->nrp;
                $nrpGanti = str_replace('/', '-', $nrp);
                @endphp
                {{-- {{ route('admin.personil.data-kepangkatan.store', ['nrp' => $nrpGanti]) }} --}}
                <form method="POST" action="">
                    @csrf
                    <input type="hidden" name="personil_id" value="{{ $personil->id }}">
                    <div class="form-group">
                      <label for="pangkat">Massukkan Pangkat baru</label>
                      <input type="text" class="form-control @error('pangkat') is-invalid @enderror" id="pangkat" name="pangkat" value="{{ old('pangkat')}}" placeholder="Nama Pangkat" autofocus>
                      @error('pangkat')
                          <div class="invalid-feedback">
                            {{ $message }}
                          </div>
                      @enderror
                    </div>
                    <div class="form-group">
                      <label for="no_skep">Masukkan nomor SKEP baru</label>
                      <input type="text" class="form-control @error('no_skep') is-invalid @enderror" id="no_skep" name="no_skep" placeholder="Format: KED/x/x/x" value="{{ old('no_skep')}}">
                      @error('no_skep')
                          <div class="invalid-feedback">
                            {{ $message }}
                          </div>
                      @enderror
                    </div>
                    <div class="form-group">
                      <label for="tempat_pangkat">Massukkan tempat pangkat baru</label>
                      <input type="text" class="form-control @error('tempat_pangkat') is-invalid @enderror" id="tempat_pangkat" name="tempat_pangkat" placeholder="Tempat pangkat" value="{{ old('tempat_pangkat')}}">
                      @error('tempat_pangkat')
                          <div class="invalid-feedback">
                            {{ $message }}
                          </div>
                      @enderror
                    </div>
                    <div class="form-group">
                      <label for="keterangan">Massukkan keterangan (opsional)</label>
                      <input type="text" class="form-control @error('keterangan') is-invalid @enderror" id="keterangan" name="keterangan" placeholder="Keterangan" value="{{ old('keterangan')}}">
                      @error('keterangan')
                          <div class="invalid-feedback">
                            {{ $message }}
                          </div>
                      @enderror
                    </div>
                    <a class="text-decoration-none btn btn-blue text-white bg-gray" href="{{ route('admin.personil.data-kepangkatan.index', $nrpGanti) }}">
                      <span><iconify-icon icon="ep:arrow-left"></iconify-icon></span>Kembali
                    </a>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
        
    </div>

@endsection