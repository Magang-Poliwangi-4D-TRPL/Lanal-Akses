@extends('layout.admin.app')

@section('title-page', 'Personil | Tambah Data Sanksi Hukuman Personil')

@section('content')
    <div class="container">
        <div class="container">
            <h1 class="text-bold">Tambah Data Sanksi Hukuman</h1>
            <h4 class="mt-3">Tambahkan data sanksi hukuman personil baru</h4>

            {{-- Form Start --}}
            <div class="container bg-white border rounded p-5 mt-4">
                @php
                $nrp = $personil->nrp;
                $nrpGanti = str_replace('/', '-', $nrp);
                @endphp
                {{-- {{ route('admin.personil.sanksi-hukuman.store', ['nrp' => $nrpGanti]) }} --}}
                <form method="POST" action="">
                    @csrf
                    <input type="hidden" name="personil_id" value="{{ $personil->id }}">
                    <div class="form-group">
                        <label for="nama_hukuman">Massukkan nama sanksi hukuman baru</label>
                        <input type="text" class="form-control @error('nama_hukuman') is-invalid @enderror" id="nama_hukuman" name="nama_hukuman" required autofocus placeholder="Nama sanksi hukuman" value="{{ old('nama_hukuman')}}">
                        @error('nama_hukuman')
                            <div class="invalid-feedback">
                              {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="tahun_hukuman">Massukkan Tahun Hukuman baru</label>
                        <input type="text" class="form-control @error('tahun_hukuman') is-invalid @enderror" id="tahun_hukuman" name="tahun_hukuman" required placeholder="YYYY" value="{{ old('tahun_hukuman')}}">
                        @error('tahun_hukuman')
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
                    <a class="text-decoration-none btn btn-blue text-white bg-gray" href="{{ route('admin.personil.sanksi-hukuman.index', $nrpGanti) }}">
                      <span><iconify-icon icon="ep:arrow-left"></iconify-icon></span>Kembali
                    </a>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
        
    </div>

@endsection